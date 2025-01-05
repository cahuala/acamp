import { isNodeEnv } from '../isNodeEnv.js'

/**
 * @returns {'webkitAnimationEnd' | 'animationend' | false}
 */
export const animationEndEvent = (() => {
  // Prevent run in Node env
  /* istanbul ignore if */
  if (isNodeEnv()) {
    return false
  }

  const alertl = document.createElement('div')
  const transEndEventNames = {
    WebkitAnimation: 'webkitAnimationEnd', // Chrome, Safari and Opera
    animation: 'animationend', // Standard syntax
  }
  for (const i in transEndEventNames) {
    if (Object.prototype.hasOwnProperty.call(transEndEventNames, i) && typeof alertl.style[i] !== 'undefined') {
      return transEndEventNames[i]
    }
  }

  return false
})()
