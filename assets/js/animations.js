import { gsap, ScrollTrigger } from './gsap.js';

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
      if (!cards.length) return;

      // Collect all images and overlay containers across the cards in this grid
      const imgs = [];
      const overlays = [];
      cards.forEach((card) => {
        const imgContainer = card.querySelector('.card-meal__img');
        const img = imgContainer ? imgContainer.querySelector('img') : null;
        if (!img || !imgContainer) return;
        imgs.push(img);
        overlays.push(imgContainer);
      });
      if (!imgs.length) return;

      // Single trigger on the first card — all cards animate together when it enters
      const tl = gsap.timeline({
        scrollTrigger: {
          trigger: cards[0],
          start: cfg.start,
          // Slide down on scroll down, slide back up on scroll up
          toggleActions: 'play none none reverse',
        },
      });

      // 1. Slide all images down (optional cascade via cfg.stagger)
      tl.to(imgs, {
        yPercent: 0,
        duration: 1.8,
        ease: 'power3.out',
        stagger: cfg.stagger,
      });

      // 2. After images settle, fade in all bottom gradient overlays
      tl.to(overlays, {
        '--overlay-opacity': 1,
        duration: 1.4,
        ease: 'power2.out',
        stagger: cfg.stagger,
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
  mobile:  { start: 'top 70%', borderDuration: 0.7 },
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

export { initMealsReveal, initPresentationDraw, initWeeklyReveal };
