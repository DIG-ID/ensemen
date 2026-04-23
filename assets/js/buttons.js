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

function initAnimatedButton( selector, strokeColor, pressedStrokeColor = null ) {
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

		if ( pressedStrokeColor ) {
			btn.addEventListener( 'mousedown', () => path.setAttribute( 'stroke', pressedStrokeColor ) );
			btn.addEventListener( 'mouseup', () => path.setAttribute( 'stroke', strokeColor ) );
			btn.addEventListener( 'mouseleave', () => path.setAttribute( 'stroke', strokeColor ) );
		}

		btn.addEventListener( 'mouseenter', () => {
			const w = btn.offsetWidth;
			const h = btn.offsetHeight;

			svg.setAttribute( 'viewBox', `0 0 ${ w } ${ h }` );
			path.setAttribute( 'd', buildBorderPath( w, h, BORDER_RADIUS ) );

			const length = path.getTotalLength();
			gsap.set( path, { strokeDasharray: length, strokeDashoffset: length } );

			if ( anim ) anim.kill();
			anim = gsap.to( path, {
				strokeDashoffset: 0,
				duration: 2.5,
				ease: 'power2.out',
			} );
		} );

		btn.addEventListener( 'mouseleave', () => {
			if ( anim ) anim.kill();
			anim = gsap.to( path, {
				strokeDashoffset: path.getTotalLength(),
				duration: 1.2,
				ease: 'power2.in',
			} );
		} );
	} );
}

function initPrimaryButtons() {
	initAnimatedButton( '.btn-primary', '#F1F2ED', '#874644' );
}

function initHeaderButtons() {
	initAnimatedButton( '.btn-header', '#F1F2ED', '#874644' );
}

function initReservationButtons() {
	initAnimatedButton( '.btn-reservation', '#874644' );
}

function initFooterButtons() {
	initAnimatedButton( '.btn-footer', '#874644' );
}

export { initPrimaryButtons, initHeaderButtons, initReservationButtons, initFooterButtons };
