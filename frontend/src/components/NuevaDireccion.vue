<template>
  <v-dialog
    v-model="dialog"
    scrollable
    :overlay="false"
    max-width="500px"
    transition="dialog-transition"
    @update:returnValue="closeDialog()">
    <v-card>
      <v-toolbar flat dark color="green">
        <v-toolbar-title> Tu Dirección </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon @click="closeDialog()">
          <v-icon>close</v-icon>
        </v-btn>
      </v-toolbar>
      <v-card-text>
        <v-container grid-lis-md>
          <v-layout wrap>
            <v-form v-model="valid" lazy-validation>
              <v-flex xs12>
                {{ direccion.fullUrl }}
                <!--<v-text-field :rules="rules" v-model="direccion.url" label="Dirección url" color="green" required></v-text-field>-->
              </v-flex>
            </v-form>
          </v-layout>
          <v-flex xs12>
            <v-btn :disabled="!valid" dark block color="green" @click="acortarDireccion(direccion)">Acortar Dirección</v-btn>
          </v-flex>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import {acortaService} from '@/services/Acorta.service'
export default {
  data () {
    return {
      valid: false,
      direccion: {},
      rules: [
        v => !!v || 'Campo es requerido'
      ]
    }
  },
  props: ['dialog'],
  methods: {
    acortarDireccion (direccion) {
      let vm = this
      acortaService.save(direccion).then(data => {
        vm.closeDialog()
        if (data.body.error) {
          alert('Direccion de url Invalida')
        }
        vm.$emit('nuevaDireccion', direccion, data.body)
      }, err => {
        alert('error')
        console.log(err)
      })
    },
    closeDialog () {
      let vm = this
      vm.$emit('closeDialog')
      vm.direccion = {}
    }
  }
}
</script>

