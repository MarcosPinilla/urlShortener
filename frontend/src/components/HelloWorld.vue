<template>
  <v-container fluid  grid-list-md>
    <v-layout row wrap>
      <v-flex xs12>
        <h1>Lista de Direcciones Acortadas</h1>
      </v-flex>
      <v-flex xs4>
        <v-btn @click="dialog = true" dark color="green">
          Acortar Direccion
        </v-btn>
      </v-flex>
    </v-layout>
    <v-layout row wrap>
      <v-flex xs12 md2>
      </v-flex>
      <v-flex xs12 md8>
        <v-data-table
          :headers="headers"
          :items="direcciones"
          :pagination.sync="pagination"
          class="elevation-1"
        >
          <template slot="items" slot-scope="props">
            <td>{{ props.item.id }}</td>
            <td class="text-xs-left"><a :href="props.item.fullUrl">{{ props.item.fullUrl }}</a></td>
            <td class="text-xs-left"><a :href="'localhost:8000/' + props.item.short">localhost:8000/{{ props.item.short }}</a></td>
          </template>
        </v-data-table>
      </v-flex>
      <v-flex xs12 md2></v-flex>
    </v-layout>
    <direccion-form @nuevaDireccion="nuevaDireccion" @closeDialog="dialog = false" :dialog="dialog"></direccion-form>
  </v-container>
</template>

<script>
import {direccionService} from '@/services/Direccion.service'
import DireccionForm from '@/components/DireccionForm'
export default {
  data () {
    return {
      pagination: {
        sortBy: 'id',
        descending: true
      },
      headers: [
        {
          text: 'Id',
          align: 'left',
          value: 'id'
        },
        { text: 'Url', value: 'fullUrl' },
        { text: 'short', value: 'short' }
      ],
      direcciones: [],
      dialog: false
    }
  },
  mounted () {
    let vm = this
    direccionService.query().then(data => {
      vm.direcciones = data.body
    }, erro => {
      console.log('error')
    })
  },
  methods: {
    nuevaDireccion (direccion, data) {
      let vm = this
      direccionService.query().then(data => {
        vm.direcciones = data.body
      }, erro => {
        console.log('error')
      })
    }
  },
  components: {DireccionForm}
}
</script>




