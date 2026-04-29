import { gsap } from './gsap.js';

const SVG_NS = 'http://www.w3.org/2000/svg';
const BORDER_RADIUS = 4;

/**
 * Builds the SVG path starting at bottom-center, going counterclockwise:
 * left → up left side → top → down right side → bottom-right corner → a few px along bottom.
 */
function buildBorderPath( w, h, r ) {
	const extra = 20;
	return [
		`M ${ w / 2 } ${ h }`,
		`L ${ r } ${ h }`,
		`Q 0 ${ h } 0 ${ h - r }`,
		`L 0 ${ r }`,
		`Q 0 0 ${ r } 0`,
		`L ${ w - r } 0`,
		`Q ${ w } 0 ${ w } ${ r }`,
		`L ${ w } ${ h - r }`,
		`Q ${ w } ${ h } ${ w - r } ${ h }`,
		`L ${ w - r - extra } ${ h }`,
	].join( ' ' );
}

/**
 * Animated button border.
 *
 * @param {string}  selector            CSS selector for the button(s).
 * @param {string}  strokeColor         Stroke colour for the SVG path.
 * @param {?string} pressedStrokeColor  Optional stroke colour while mousedown.
 * @param {boolean} reverse             When true, the line is drawn by default
 *                                      and animates AWAY on hover (un-draws),
 *                                      then redraws on leave. When false, line
 *                                      is hidden and draws on hover (default).
 */
function initAnimatedButton( selector, strokeColor, pressedStrokeColor = null, reverse = false ) {
	document.querySelectorAll( selector ).forEach( ( btn ) => {
		const svg = document.createElementNS( SVG_NS, 'svg' );
		svg.style.cssText = 'position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none;overflow:visible;';

		const path = document.createElementNS( SVG_NS, 'path' );
		path.setAttribute( 'fill', 'none' );
		path.setAttribute( 'stroke', strokeColor );
		path.setAttribute( 'stroke-width', '2' );

		svg.appendChild( path );
		btn.appendChild( svg );

		let anim = null;

		// Build / measure the path based on the button's current dimensions
		const setupPath = () => {
			const w = btn.offsetWidth;
			const h = btn.offsetHeight;
			svg.setAttribute( 'viewBox', `0 0 ${ w } ${ h }` );
			path.setAttribute( 'd', buildBorderPath( w, h, BORDER_RADIUS ) );
			return path.getTotalLength();
		};

		if ( reverse ) {
			// Reverse mode — draw the line immediately so it's visible by default.
			// Re-measure after layout settles (fonts, images) to keep the path accurate.
			const apply = () => {
				const length = setupPath();
				gsap.set( path, { strokeDasharray: length, strokeDashoffset: 0 } );
			};
			apply();
			window.addEventListener( 'load', apply );
		}

		if ( pressedStrokeColor ) {
			btn.addEventListener( 'mousedown', () => path.setAttribute( 'stroke', pressedStrokeColor ) );
			btn.addEventListener( 'mouseup', () => path.setAttribute( 'stroke', strokeColor ) );
			btn.addEventListener( 'mouseleave', () => path.setAttribute( 'stroke', strokeColor ) );
		}

		btn.addEventListener( 'mouseenter', () => {
			const length = setupPath();

			if ( anim ) anim.kill();

			if ( reverse ) {
				// Un-draw — line wipes off in reverse direction
				anim = gsap.to( path, {
					strokeDashoffset: length,
					duration: 1,
					ease: 'none',
				} );
			} else {
				gsap.set( path, { strokeDasharray: length, strokeDashoffset: length } );
				anim = gsap.to( path, {
					strokeDashoffset: 0,
					duration: 1,
					ease: 'none',
				} );
			}
		} );

		btn.addEventListener( 'mouseleave', () => {
			if ( anim ) anim.kill();

			if ( reverse ) {
				// Redraw — line traces back in
				anim = gsap.to( path, {
					strokeDashoffset: 0,
					duration: 0.8,
					ease: 'none',
				} );
			} else {
				anim = gsap.to( path, {
					strokeDashoffset: path.getTotalLength(),
					duration: 0.8,
					ease: 'none',
				} );
			}
		} );
	} );
}

function initPrimaryButtons() {
	initAnimatedButton( '.btn-primary', '#F1F2ED', '#874644', true );
}

function initFormButtons() {
	initAnimatedButton( '.btn-form', '#874644', '#F1F2ED', true );
}

function initHeaderButtons() {
	initAnimatedButton( '.btn-header', '#F1F2ED', '#874644' );
}

function initReservationButtons() {
	initAnimatedButton( '.btn-reservation', '#F1F2ED' );
}

function initFooterButtons() {
	initAnimatedButton( '.btn-footer', '#874644' );
}

export { initPrimaryButtons, initFormButtons, initHeaderButtons, initReservationButtons, initFooterButtons };
