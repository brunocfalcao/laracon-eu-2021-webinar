Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'blade-view',
      path: '/blade-view',
      component: require('./components/Tool'),
    },
  ])
})
