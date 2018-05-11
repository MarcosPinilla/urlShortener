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
        <v-toolbar-title> Crear Propiedad </v-toolbar-title>
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
              <v-text-field :readonly="lectura" :rules="rules" v-model="propiedad.nombre" label="Nombre" color="green" required></v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-text-field :readonly="lectura" :rules="rules" v-model="propiedad.descripcion" label="Descripción" color="green" required></v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-text-field :readonly="lectura" :rules="rules" v-model="propiedad.codigo" label="Codigo" color="green" required></v-text-field>
            </v-flex>
            </v-form>
          </v-layout>
          <v-flex xs12>
            <v-btn v-if="!editar && lectura !== true " :disabled="!valid" dark block color="green" @click="agregarPropiedad(propiedad)">Agregar Propiedad</v-btn>
            <v-btn v-else-if="lectura !== true" :disabled="!valid" dark block color="green" @click="agregarPropiedad(propiedad)">Editar Propiedad</v-btn>
          </v-flex>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import {propiedadService} from '@/services/Propiedad.service'
export default {
  data () {
    return {
      valid: false,
      propiedad: {},
      rules: [
        v => !!v || 'Campo es requerido'
      ],
      editar: false,
      lectura: false
    }
  },
  props: ['dialog'],
  created () {
    let vm = this
    vm.$parent.$on('editar', propiedad => {
      vm.propiedad = propiedad
      vm.editar = true
    })

    vm.$parent.$on('ver', propiedad => {
      vm.propiedad = propiedad
      vm.lectura = true
    })
  },
  methods: {
    agregarPropiedad (propiedad) {
      let vm = this
      propiedadService.save(propiedad).then(data => {
        vm.$emit('nuevaPropiedad', propiedad)
        vm.closeDialog()
      }, err => {
        alert('error')
        console.log(err)
      })
    },
    closeDialog () {
      let vm = this
      vm.$emit('closeDialog')
      vm.propiedad = {}
      vm.editar = false
    }
  }
}
</script>

