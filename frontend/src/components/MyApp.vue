<template>
  <v-app>
    <v-navigation-drawer
      persistent
      :mini-variant="miniVariant"
      :clipped="clipped"
      v-model="drawer"
      enable-resize-watcher
      fixed
      app
    >
      <v-list>
        <v-list-tile
          value="true"
          v-for="(item, i) in items"
          :key="i"
        >
          <v-list-tile-content>
            <v-list-tile-title v-text="item.title"></v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar
      app
      :clipped-left="clipped"
    >
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title v-text="title"></v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn @click="logout" flat>Cerrar Sesion
        <v-icon dark right>exit_to_app</v-icon>
      </v-btn>
    </v-toolbar>
    <v-content>
      <router-view/>
    </v-content>
  </v-app>
</template>

<script>
import CredentialsService from '@/services/Credentials.service'
export default {
  data () {
    return {
      clipped: false,
      drawer: true,
      fixed: false,
      items: [{
        title: 'Direcciones'
      }],
      miniVariant: false,
      right: true,
      rightDrawer: false,
      title: 'Acortador de Direcciones',
      credenciales: new CredentialsService()
    }
  },
  methods: {
    logout () {
      let vm = this
      vm.credenciales.clearCredentials()
      vm.$router.push('/login')
    }
  },
  name: 'App'
}
</script>