import easings from "./easings";

/**
 * @type {RegExp}
 */
const NUMBER_RE = /^\d+$/;

/**
 * @param {Element|number} destination
 * @param {?number} duration
 * @param {?string} easing
 * @param {?number} offset
 *
 * @returns {Promise<any>}
 */
export function scrollIt (destination, duration = 200, easing = 'linear', offset = 0) {
  return new Promise(resolve => {
    const documentHeight = Math.max(document.body.scrollHeight, document.body.offsetHeight, document.documentElement.clientHeight, document.documentElement.scrollHeight, document.documentElement.offsetHeight);
    const windowHeight = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;
    const destinationOffset = typeof destination === 'number' ? destination : destination.offsetTop;
    let destinationOffsetToScroll = Math.round(documentHeight - destinationOffset < windowHeight ? documentHeight - windowHeight : destinationOffset);

    if (offset) {
      destinationOffsetToScroll += offset;
    }

    if ('requestAnimationFrame' in window === false) {
      window.scroll(0, destinationOffsetToScroll);
      return resolve();
    }

    const start = window.pageYOffset;
    const startTime = 'now' in window.performance ? performance.now() : new Date().getTime();

    function scroll() {
      const now = 'now' in window.performance ? performance.now() : new Date().getTime();
      const time = Math.min(1, ((now - startTime) / duration));
      const timeFunction = easings[easing](time);
      const y = Math.round(window.pageYOffset);

      window.scroll(0, Math.ceil((timeFunction * (destinationOffsetToScroll - start)) + start));

      if (y === destinationOffsetToScroll) {
        return resolve();
      }

      requestAnimationFrame(scroll);
    }

    scroll();
  });
}

/**
 * @param {Event} event
 */
export function scrollTo(event) {
  const dataset = (event.currentTarget || event.target).dataset;
  let destination = dataset.scroll;

  if (NUMBER_RE.test(destination)) {
    destination = parseInt(destination, 10) || 0;
  } else {
    destination = document.querySelector(destination);
    if (!destination) {
      return;
    }
  }

  const duration = parseInt(dataset.duration, 10) || 300;
  const easing = dataset.easing || 'easeOutQuad';
  const offset = parseInt(dataset.offset, 10) || 0;

  event.preventDefault();
  scrollIt(destination, duration, easing, offset);
}