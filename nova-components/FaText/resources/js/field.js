Nova.booting((Vue, router, store) => {
  Vue.component('index-fa-text', require('./components/IndexField'))
  Vue.component('detail-fa-text', require('./components/DetailField'))
  Vue.component('form-fa-text', require('./components/FormField'))
})
