Nova.booting((Vue, router, store) => {
  Vue.component('index-repeat-row', require('./components/IndexField'))
  Vue.component('detail-repeat-row', require('./components/DetailField'))
  Vue.component('form-repeat-row', require('./components/FormField'))
})
