Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'universal-blade-tool',
      path: '/universal-blade-tool',
      component: require('./components/Tool'),
    },
  ])
})
