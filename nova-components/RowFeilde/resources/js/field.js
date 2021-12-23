Nova.booting((Vue, router, store) => {
  Vue.component('index-row-feilde', require('./components/IndexField'))
  Vue.component('detail-row-feilde', require('./components/DetailField'))
  Vue.component('form-row-feilde', require('./components/FormField'))
})
