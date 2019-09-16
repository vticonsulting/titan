export const info = JSON.stringify({
  date: new Date(),
  agent: navigator.userAgent,
  screen: {
    availWidth: screen.availWidth,
    availHeight: screen.availHeight,
    width: screen.width,
    height: screen.height
  },
  window: {
    innerWidth: window.innerWidth,
    innerHeight: window.innerHeight
  },
  hasPlugins: 'length' in navigator.plugins && navigator.plugins.length > 0
})

// jQuery().ready(function($) {
//   $('input[name^=ubafs-]', 'form').remove()

//   const info = JSON.stringify({
//     date: new Date(),
//     agent: navigator.userAgent,
//     screen: {
//       availWidth: screen.availWidth,
//       availHeight: screen.availHeight,
//       width: screen.width,
//       height: screen.height
//     },
//     window: {
//       innerWidth: window.innerWidth,
//       innerHeight: window.innerHeight
//     },
//     hasPlugins: 'length' in navigator.plugins && navigator.plugins.length > 0
//   })

//   const jevField = $(
//     '<input type="hidden" id="ubafs-jev" name="ubafs-jev">'
//   ).val(info)
//   $('form').append(jevField)
// })
