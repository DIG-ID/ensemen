import { gsap, ScrollTrigger } from './gsap.js';

/**
 * Animation presets mapped to data-animate attribute values.
 *
 * Usage in HTML:
 *   data-animate="fade-up"      — fade in + slide up (default)
 *   data-animate="fade-down"    — fade in + slide down
 *   data-animate="fade-left"    — fade in + slide from left
 *   data-animate="fade-right"   — fade in + slide from right
 *   data-animate="fade-in"      — fade in only (no movement)
 *   data-animate="zoom-in"      — fade in + scale up
 *   data-animate="zoom-out"     — fade in + scale down
 *   data-animate="flip-up"      — fade in + rotate X
 *   data-animate="slide-up"     — slide up (no fade)
 *
 * Optional data attributes:
 *   data-animate-delay="0.2"    — delay in seconds
 *   data-animate-duration="1"   — duration in seconds
 *   data-animate-start="top 75%" — ScrollTrigger start position
 *   data-animate-once="true"    — play only once (default: repeats on re-enter)
 *   data-animate-eager          — animate immediately on page load (no ScrollTrigger)
 *   data-animate-scrub          — animation tied 1:1 to scroll position (forward + reverse)
 *   data-animate-scrub="2"     — scrub with smoothing (higher = more lag behind scroll)
 *   data-animate-end="bottom top" — ScrollTrigger end position (only used with scrub)
 *   data-animate-stagger="0.1"  — stagger children with [data-animate-child]
 */
const presets = {
  'fade-up':    { y: 60, autoAlpha: 0 },
  'fade-down':  { y: -60, autoAlpha: 0 },
  'fade-left':  { x: -60, autoAlpha: 0 },
  'fade-right': { x: 60, autoAlpha: 0 },
  'fade-in':    { autoAlpha: 0 },
  'zoom-in':    { scale: 0.85, autoAlpha: 0 },
  'zoom-out':   { scale: 1.15, autoAlpha: 0 },
  'flip-up':    { rotationX: 15, y: 40, autoAlpha: 0, transformPerspective: 800 },
  'slide-up':   { y: 80 },
};

const defaultPreset = 'fade-up';

function initAnimations() {
  const elements = gsap.utils.toArray('[data-animate]');

  elements.forEach((el) => {
    const type = el.getAttribute('data-animate') || defaultPreset;
    const delay = parseFloat(el.getAttribute('data-animate-delay')) || 0;
    const duration = parseFloat(el.getAttribute('data-animate-duration')) || 0.8;
    const start = el.getAttribute('data-animate-start') || 'top 70%';
    const stagger = parseFloat(el.getAttribute('data-animate-stagger')) || 0;
    const once = el.getAttribute('data-animate-once') === 'true';
    const eager = el.hasAttribute('data-animate-eager');
    const hasScrub = el.hasAttribute('data-animate-scrub');
    const scrubVal = el.getAttribute('data-animate-scrub');
    const end = el.getAttribute('data-animate-end') || 'bottom top';

    const from = presets[type] || presets[defaultPreset];
    const to = resetProps(from);

    // Eager mode: animate immediately, no ScrollTrigger
    if (eager) {
      if (stagger > 0) {
        const children = el.querySelectorAll('[data-animate-child]');
        if (children.length) {
          gsap.fromTo(children, from, {
            ...to,
            duration,
            delay,
            stagger,
            ease: 'power2.out',
          });
          return;
        }
      }

      gsap.fromTo(el, from, {
        ...to,
        duration,
        delay,
        ease: 'power2.out',
      });
      return;
    }

    // Scrub mode: animation tied to scroll position
    if (hasScrub) {
      // scrub value: true (1:1), or a number for smoothing
      const scrub = scrubVal && scrubVal !== '' ? parseFloat(scrubVal) : true;

      if (stagger > 0) {
        const children = el.querySelectorAll('[data-animate-child]');
        if (children.length) {
          const tl = gsap.timeline({
            scrollTrigger: {
              trigger: el,
              start: start,
              end: end,
              scrub: scrub,
            },
          });
          tl.fromTo(children, from, {
            ...to,
            duration: duration,
            stagger: stagger,
            ease: 'none',
          });
          return;
        }
      }

      gsap.fromTo(el, from, {
        ...to,
        ease: 'none',
        scrollTrigger: {
          trigger: el,
          start: start,
          end: end,
          scrub: scrub,
        },
      });
      return;
    }

    // Stagger mode: animate children instead of the parent
    if (stagger > 0) {
      const children = el.querySelectorAll('[data-animate-child]');
      if (children.length) {
        const tl = gsap.timeline({
          paused: true,
          defaults: { ease: 'power2.out' },
        });
        tl.fromTo(children, from, {
          ...to,
          duration: duration,
          delay: delay,
          stagger: stagger,
        });

        ScrollTrigger.create({
          trigger: el,
          start: start,
          onEnter: () => tl.restart(),
          onLeaveBack: once ? undefined : () => tl.reverse(),
        });
        return;
      }
    }

    // Single element animation — use a timeline for clean reverse
    const tl = gsap.timeline({
      paused: true,
      defaults: { ease: 'power2.out' },
    });
    tl.fromTo(el, from, {
      ...to,
      duration: duration,
      delay: delay,
    });

    ScrollTrigger.create({
      trigger: el,
      start: start,
      onEnter: () => tl.restart(),
      onLeaveBack: once ? undefined : () => tl.reverse(),
    });
  });
}

/**
 * Build a "to" tween object that resets all animated properties to their
 * natural values (0 for transforms, 1 for opacity/scale).
 */
function resetProps(from) {
  const to = {};
  if ('y' in from) to.y = 0;
  if ('x' in from) to.x = 0;
  if ('autoAlpha' in from) to.autoAlpha = 1;
  if ('scale' in from) to.scale = 1;
  if ('rotationX' in from) to.rotationX = 0;
  if ('transformPerspective' in from) to.transformPerspective = 800;
  return to;
}

/**
 * Parallax effect driven by scroll position.
 *
 * Usage in HTML:
 *   data-parallax="100"         — moves 100px upward as you scroll (default direction: up)
 *   data-parallax="-80"         — moves 80px downward as you scroll
 *   data-parallax-x="60"       — horizontal parallax (positive = moves right)
 *   data-parallax-speed="0.5"  — multiplier for scrub speed (default: 1)
 *   data-parallax-start         — ScrollTrigger start (default: "top bottom")
 *   data-parallax-end           — ScrollTrigger end (default: "bottom top")
 */
function initParallax() {
  const elements = gsap.utils.toArray('[data-parallax], [data-parallax-x]');

  elements.forEach((el) => {
    const yVal = parseFloat(el.getAttribute('data-parallax')) || 0;
    const xVal = parseFloat(el.getAttribute('data-parallax-x')) || 0;
    const speed = parseFloat(el.getAttribute('data-parallax-speed')) || 1;
    const start = el.getAttribute('data-parallax-start') || 'top bottom';
    const end = el.getAttribute('data-parallax-end') || 'bottom top';

    const toVars = {};
    if (yVal) toVars.y = yVal;
    if (xVal) toVars.x = xVal;

    gsap.to(el, {
      ...toVars,
      ease: 'none',
      scrollTrigger: {
        trigger: el,
        start: start,
        end: end,
        scrub: speed,
      },
    });
  });
}

/**
 * Banner intro timeline: subtitle fade-in → title typewriter → CTA fade-up.
 *
 * Markup contract (data attributes on banner.php):
 *   [data-banner-intro]      — wrapper (timeline scope)
 *   [data-banner-subtitle]   — overline / subtitle
 *   [data-banner-typewriter] — title with typewriter effect
 *   [data-banner-cta]        — call-to-action button
 *
 * Optional on [data-banner-typewriter]:
 *   data-banner-cursor="persist" — cursor keeps blinking after typing (default)
 *   data-banner-cursor="hide"    — cursor fades out after typing finishes
 */
function initBannerIntro() {
  const wrapper = document.querySelector('[data-banner-intro]');
  if (!wrapper) return;

  const subtitle = wrapper.querySelector('[data-banner-subtitle]');
  const titleEl = wrapper.querySelector('[data-banner-typewriter]');
  const cta = wrapper.querySelector('[data-banner-cta]');
  const cursorMode = titleEl ? (titleEl.getAttribute('data-banner-cursor') || 'persist') : 'persist';

  // Set initial states (CSS already hides with opacity:0/visibility:hidden)
  if (subtitle) gsap.set(subtitle, { autoAlpha: 0, y: 20 });
  if (cta) gsap.set(cta, { autoAlpha: 0, y: 20 });

  // Prepare typewriter structure
  const titleText = titleEl ? titleEl.textContent.trim() : '';
  let textSpan = null;
  let cursorEl = null;
  if (titleEl && titleText) {
    titleEl.textContent = '';
    titleEl.style.position = 'relative';

    const placeholder = document.createElement('span');
    placeholder.className = 'typewriter-placeholder';
    placeholder.textContent = titleText;

    textSpan = document.createElement('span');
    textSpan.className = 'typewriter-text';

    cursorEl = document.createElement('span');
    cursorEl.className = 'typewriter-cursor';
    cursorEl.textContent = '|';

    const overlay = document.createElement('span');
    overlay.className = 'typewriter-overlay';
    overlay.appendChild(textSpan);
    overlay.appendChild(cursorEl);

    titleEl.appendChild(placeholder);
    titleEl.appendChild(overlay);

    // Reveal the title container (CSS hid it to prevent FOUC)
    gsap.set(titleEl, { autoAlpha: 1 });
  }

  // Build the timeline
  const tl = gsap.timeline({ delay: 0.3 });

  // 1. Subtitle fade-in
  if (subtitle) {
    tl.to(subtitle, {
      autoAlpha: 1,
      y: 0,
      duration: 0.5,
      ease: 'power2.out',
    });
  }

  // 2. Title typewriter
  if (textSpan && titleText) {
    tl.to(textSpan, {
      text: { value: titleText, delimiter: '' },
      duration: titleText.length * 0.08,
      ease: 'none',
      onComplete: () => {
        if (cursorEl && cursorMode === 'hide') {
          gsap.to(cursorEl, { autoAlpha: 0, delay: 1.5, duration: 0.4 });
        }
      },
    }, '+=0.2');
  }

  // 3. CTA fade-up — overlaps slightly with end of typewriter for smooth flow
  if (cta) {
    tl.to(cta, {
      autoAlpha: 1,
      y: 0,
      duration: 0.6,
      ease: 'power2.out',
    }, '-=0.3');
  }
}

/**
 * Pinned reveal — section pins, border fades in (with scale), then title and
 * description reveal in sequence. Same pin config as the presentation section
 * but with a simple fade+scale border reveal instead of SVG line drawing.
 *
 * Markup contract (per section):
 *   [data-pinned-reveal]   — section wrapper (gets pinned)
 *   [data-reveal-border]   — bordered box
 *   [data-reveal-title]    — title
 *   [data-reveal-desc]     — description
 */
function initPinnedReveal() {
  const sections = document.querySelectorAll('[data-pinned-reveal]');
  if (!sections.length) return;

  sections.forEach((section) => {
    const border = section.querySelector('[data-reveal-border]');
    const title = section.querySelector('[data-reveal-title]');
    const desc = section.querySelector('[data-reveal-desc]');

    // Initial states (same as initPresentationDraw)
    if (border) gsap.set(border, { autoAlpha: 0, scale: 0.94, transformOrigin: '50% 50%' });
    if (title) gsap.set(title, { autoAlpha: 0, y: 30, filter: 'blur(8px)' });
    if (desc) gsap.set(desc, { autoAlpha: 0, y: 30, filter: 'blur(8px)' });

    // Pinned scrubbed timeline — same config as initPresentationDraw
    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: section,
        start: 'top top-=150',
        end: '+=2000',
        scrub: 1.2,
        pin: true,
        anticipatePin: 1,
        pinType: 'transform',
        invalidateOnRefresh: true,
      },
    });

    // Buffer at start
    tl.to({}, { duration: 0.15 });

    // 1. Border fade + scale-in (replaces the SVG line drawing of the presentation)
    if (border) {
      tl.to(border, {
        autoAlpha: 1,
        scale: 1,
        duration: 4.5,
        ease: 'power2.out',
      });
    }

    // 2. Title — exactly the same config as the presentation
    if (title) {
      tl.to(title, {
        autoAlpha: 1,
        y: 0,
        filter: 'blur(0px)',
        duration: 1.2,
        ease: 'power3.out',
      }, '+=0.15');
    }

    // 3. Description — exactly the same config as the presentation
    if (desc) {
      tl.to(desc, {
        autoAlpha: 1,
        y: 0,
        filter: 'blur(0px)',
        duration: 1.2,
        ease: 'power3.out',
      }, '-=0.7');
    }

    // Buffer at end
    tl.to({}, { duration: 0.2 });
  });
}

/**
 * Meals cards — image slide-down reveal.
 * Each card's image starts hidden above its bordered container and slides
 * down into place when the card enters the viewport.
 *
 * The container (.card-meal__img) already has overflow: hidden, so the
 * sliding image stays clipped within the rounded border.
 *
 * Markup contract:
 *   [data-meals-card]      — each card wrapper
 *   .card-meal__img img    — the image to slide
 */
const MEALS_CONFIG = {
  desktop: { start: 'top 70%', stagger: 0 },
  tablet:  { start: 'top 85%', stagger: 0 },
  mobile:  { start: 'top 85%', stagger: 0 },
};

function initMealsReveal() {
  // Each grid wrapper has its own cumulative delay so the mobile/desktop and
  // tablet layouts (rendered as separate DOMs and toggled via responsive
  // visibility) animate from index 0 inside their own container.
  const grids = document.querySelectorAll('[data-meals-grid]');
  if (!grids.length) return;

  // Initial states — applied once, regardless of breakpoint
  grids.forEach((grid) => {
    const cards = grid.querySelectorAll('[data-meals-card]');
    cards.forEach((card) => {
      const imgContainer = card.querySelector('.card-meal__img');
      const img = imgContainer ? imgContainer.querySelector('img') : null;
      if (!img || !imgContainer) return;
      gsap.set(img, { yPercent: -100 });
      gsap.set(imgContainer, { '--overlay-opacity': 0 });
    });
  });

  const buildTriggers = (cfg) => {
    grids.forEach((grid) => {
      const cards = grid.querySelectorAll('[data-meals-card]');
      // Per-grid stagger override via data-meals-stagger; falls back to config
      const staggerAttr = parseFloat(grid.getAttribute('data-meals-stagger'));
      const stagger = !isNaN(staggerAttr) ? staggerAttr : cfg.stagger;

      cards.forEach((card, index) => {
        const imgContainer = card.querySelector('.card-meal__img');
        const img = imgContainer ? imgContainer.querySelector('img') : null;
        if (!img || !imgContainer) return;

        // Per-card delay override via data-meals-delay; otherwise cumulative cascade
        const delayAttr = card.getAttribute('data-meals-delay');
        const delay = delayAttr !== null ? parseFloat(delayAttr) : index * stagger;

        const tl = gsap.timeline({
          delay: delay,
          scrollTrigger: {
            trigger: card,
            start: cfg.start,
            // Slide down on scroll down, slide back up on scroll up
            toggleActions: 'play none none reverse',
          },
        });

        // 1. Slide image down into the bordered container
        tl.to(img, {
          yPercent: 0,
          duration: 1.8,
          ease: 'power3.out',
        });

        // 2. After the image has settled, fade in the bottom gradient overlay
        tl.to(imgContainer, {
          '--overlay-opacity': 1,
          duration: 1.4,
          ease: 'power2.out',
        });
      });
    });
  };

  const mm = gsap.matchMedia();
  mm.add('(min-width: 1280px)', () => buildTriggers(MEALS_CONFIG.desktop));
  mm.add('(min-width: 768px) and (max-width: 1279px)', () => buildTriggers(MEALS_CONFIG.tablet));
  mm.add('(max-width: 767px)', () => buildTriggers(MEALS_CONFIG.mobile));
}

/**
 * Presentation section — SVG border line drawing reveal (no pin).
 * Sequence:
 *   1. Section enters viewport at the configured start position.
 *   2. SVG path traces the bordered rectangle (line drawing effect, like the buttons).
 *   3. Title and description fade in once the line is drawn.
 *
 * Markup contract on presentation.php:
 *   [data-presentation-draw] — section wrapper (trigger)
 *   [data-reveal-border]     — bordered box (CSS border hidden, SVG drawn here)
 *   [data-reveal-title]      — title
 *   [data-reveal-desc]       — description
 *
 * Per-breakpoint trigger tuning lives in PRESENTATION_CONFIG below.
 */
const PRESENTATION_CONFIG = {
  // Desktop ≥ 1280px
  desktop: {
    start: 'top 60%',
    drawDuration: 2.5,
  },
  // Tablet 768–1279px
  tablet: {
    start: 'top 65%',
    drawDuration: 2,
  },
  // Mobile < 768px
  mobile: {
    start: 'top 70%',
    drawDuration: 1.8,
  },
};

function initPresentationDraw() {
  const section = document.querySelector('[data-presentation-draw]');
  if (!section) return;

  const border = section.querySelector('[data-reveal-border]');
  const title = section.querySelector('[data-reveal-title]');
  const desc = section.querySelector('[data-reveal-desc]');
  if (!border) return;

  // Tell SCSS to hide the static border + gap overlay (SVG takes over)
  border.classList.add('is-svg-drawn');

  // Build the SVG layer
  const SVG_NS = 'http://www.w3.org/2000/svg';
  const svg = document.createElementNS(SVG_NS, 'svg');
  svg.style.cssText = 'position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none;overflow:visible;';
  const path = document.createElementNS(SVG_NS, 'path');
  svg.appendChild(path);
  border.appendChild(svg);

  // Top-gap position per breakpoint — must match SCSS values
  function getGap() {
    const vw = window.innerWidth;
    if (vw >= 1280) return { left: 172, width: 162 };
    if (vw >= 768) return { left: 67, width: 63 };
    return { left: 30, width: 30 };
  }

  // Trace the rounded rectangle clockwise, excluding the top gap segment.
  // Start at the right edge of the gap, finish at the left edge.
  function buildPath(w, h, r, gapLeft, gapWidth) {
    const gapEnd = gapLeft + gapWidth;
    return [
      `M ${gapEnd} 0`,
      `L ${w - r} 0`,
      `Q ${w} 0 ${w} ${r}`,
      `L ${w} ${h - r}`,
      `Q ${w} ${h} ${w - r} ${h}`,
      `L ${r} ${h}`,
      `Q 0 ${h} 0 ${h - r}`,
      `L 0 ${r}`,
      `Q 0 0 ${r} 0`,
      `L ${gapLeft} 0`,
    ].join(' ');
  }

  function updatePath() {
    const w = border.offsetWidth;
    const h = border.offsetHeight;
    const r = 8;
    const { left, width } = getGap();
    svg.setAttribute('viewBox', `0 0 ${w} ${h}`);
    path.setAttribute('d', buildPath(w, h, r, left, width));
    return path.getTotalLength();
  }

  let pathLength = updatePath();
  gsap.set(path, { strokeDasharray: pathLength, strokeDashoffset: pathLength });

  // Initial states for text — applied once, regardless of breakpoint
  if (title) gsap.set(title, { autoAlpha: 0, y: 30, filter: 'blur(8px)' });
  if (desc) gsap.set(desc, { autoAlpha: 0, y: 30, filter: 'blur(8px)' });

  // Build a play-once timeline using the breakpoint-specific config
  const buildTimeline = (cfg) => {
    const tl = gsap.timeline({
      paused: true,
      scrollTrigger: {
        trigger: section,
        start: cfg.start,
        toggleActions: 'play none none none',
        invalidateOnRefresh: true,
        onRefresh: () => {
          // Recompute on resize/refresh so path stays accurate
          pathLength = updatePath();
          gsap.set(path, { strokeDasharray: pathLength });
        },
      },
    });

    // 1. Draw the border line
    tl.to(path, {
      strokeDashoffset: 0,
      duration: cfg.drawDuration,
      ease: 'power2.out',
    });

    // 2. Title — starts mid-way through the line drawing so the text reveals
    // alongside the border instead of after it finishes.
    if (title) {
      tl.to(title, {
        autoAlpha: 1,
        y: 0,
        filter: 'blur(0px)',
        duration: 1.2,
        ease: 'power3.out',
      }, `-=${cfg.drawDuration * 0.9}`);
    }

    // 3. Description — slight overlap with title for a smooth flow
    if (desc) {
      tl.to(desc, {
        autoAlpha: 1,
        y: 0,
        filter: 'blur(0px)',
        duration: 1.2,
        ease: 'power3.out',
      }, '-=1.8');
    }
  };

  // Per-breakpoint timeline — gsap.matchMedia automatically creates/kills
  // the right ScrollTrigger when the viewport crosses a breakpoint
  const mm = gsap.matchMedia();
  mm.add('(min-width: 1280px)', () => buildTimeline(PRESENTATION_CONFIG.desktop));
  mm.add('(min-width: 768px) and (max-width: 1279px)', () => buildTimeline(PRESENTATION_CONFIG.tablet));
  mm.add('(max-width: 767px)', () => buildTimeline(PRESENTATION_CONFIG.mobile));
}

/**
 * Weekly section — play-once reveal triggered when the section enters the
 * viewport. Border fades + scales in, then title and description reveal in
 * sequence. No pin, no scrub.
 *
 * Markup contract on weekly.php:
 *   [data-weekly-reveal]   — section wrapper (trigger)
 *   [data-reveal-border]   — bordered box
 *   [data-reveal-title]    — title
 *   [data-reveal-desc]     — description
 */
const WEEKLY_CONFIG = {
  desktop: { start: 'top 80%', borderDuration: 0.9 },
  tablet:  { start: 'top 80%', borderDuration: 0.75 },
  mobile:  { start: 'top 60%', borderDuration: 0.7 },
};

function initWeeklyReveal() {
  const section = document.querySelector('[data-weekly-reveal]');
  if (!section) return;

  const border = section.querySelector('[data-reveal-border]');
  const title = section.querySelector('[data-reveal-title]');
  const desc = section.querySelector('[data-reveal-desc]');

  // Initial states — applied once, regardless of breakpoint
  if (border) gsap.set(border, { autoAlpha: 0, scale: 0.94, transformOrigin: '50% 50%' });
  if (title) gsap.set(title, { autoAlpha: 0, y: 30, filter: 'blur(8px)' });
  if (desc) gsap.set(desc, { autoAlpha: 0, y: 30, filter: 'blur(8px)' });

  // Build a play-once timeline using the breakpoint-specific config
  const buildTimeline = (cfg) => {
    const tl = gsap.timeline({
      paused: true,
      scrollTrigger: {
        trigger: section,
        start: cfg.start,
        toggleActions: 'play none none none',
        invalidateOnRefresh: true,
      },
    });

    // 1. Border fade + scale-in
    if (border) {
      tl.to(border, {
        autoAlpha: 1,
        scale: 1,
        duration: cfg.borderDuration,
        ease: 'power2.out',
      });
    }

    // 2. Title
    if (title) {
      tl.to(title, {
        autoAlpha: 1,
        y: 0,
        filter: 'blur(0px)',
        duration: 0.9,
        ease: 'power3.out',
      }, '-=0.45');
    }

    // 3. Description
    if (desc) {
      tl.to(desc, {
        autoAlpha: 1,
        y: 0,
        filter: 'blur(0px)',
        duration: 0.9,
        ease: 'power3.out',
      }, '-=0.7');
    }
  };

  const mm = gsap.matchMedia();
  mm.add('(min-width: 1280px)', () => buildTimeline(WEEKLY_CONFIG.desktop));
  mm.add('(min-width: 768px) and (max-width: 1279px)', () => buildTimeline(WEEKLY_CONFIG.tablet));
  mm.add('(max-width: 767px)', () => buildTimeline(WEEKLY_CONFIG.mobile));
}

export { initAnimations, initParallax, initBannerIntro, initPinnedReveal, initMealsReveal, initPresentationDraw, initWeeklyReveal };
