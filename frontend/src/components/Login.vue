<template>
  <v-app light>
    <v-card color="grey lighten-5" flat>
    <v-toolbar dark color="blue-grey darken-3" flat extended>
      <v-layout>
        <v-flex xs8 offset-xs2 md6 offset-md3 class="text-xs-center">
          <br><br>
          <h4>Mis Propiedades</h4>
      </v-flex>
      </v-layout>
    </v-toolbar>
    <v-layout row>
      <v-flex xs10 offset-xs1 md6 offset-md3>
        <v-card style="height: 350px;" class="card--flex-toolbar grey lighten-3">
          <br>
          <v-layout row wrap>
            <v-flex xs10 offset-xs1>
              <v-form>
                <v-text-field
                  label="Correo Electronico"
                  type="email"
                  v-model="credentials.email"
                  color="blue-grey darken-1"
                  required
                ></v-text-field>
                <v-text-field
                  label="Contraseña"
                  v-model="credentials.password"
                  type="password"
                  color="blue-grey darken-1"
                  required
                ></v-text-field>
                <v-btn :loading="isLoading" @click="submit(credentials)" :disabled="!isValidForm" block round large color="blue-grey darken-3 white--text">Iniciar Sesion</v-btn>
              </v-form>
            </v-flex>
          </v-layout>
        </v-card>
      </v-flex>
    </v-layout>
  </v-card>
  </v-app>
</template>

<script>
import CredentialsService from '@/services/Credentials.service'
import {loginService} from '@/services/Login.service'
export default {
  data () {
    return {
      isLoading: false,
      credentials: {
        email: '',
        password: ''
      },
      credentialsService: new CredentialsService()
    }
  },
  methods: {
    submit (credentials) {
      let vm = this
      vm.isLoading = true
      loginService.save(credentials).then(data => {
        vm.credentialsService.setToken(data.body.token)
        vm.$router.push('/')
      }, () => {
        vm.isLoading = false
        alert('credenciales erroneas')
      })
    }
  },
  computed: {
    isValidForm () {
      let vm = this
      return vm.credentials.email !== '' && vm.credentials.password !== ''
    }
  }
}
</script>
