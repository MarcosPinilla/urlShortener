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
      <v-flex xs12 md3>
        <!--<v-card dark color="red" v-for="direccion in direcciones" :key="direccion.id">
        <v-card-title primary-title>
          <div>
            <h3 class="headline mb-0">{{ direccion.fullUrl }}</h3>
            <div>{{ direccion.short }}</div>
          </div>
        </v-card-title>
        <v-card-actions>
          <v-btn color="blue" @click="verPropiedad(direccion)">Ver</v-btn>
          <v-btn color="blue" @click="editarPropiedad(direccion)">Editar</v-btn>
        </v-card-actions>
      </v-card>-->
      </v-flex>
      <v-flex xs12 md6>
        <v-data-table
          :headers="headers"
          :items="direcciones"
          hide-actions
          class="elevation-1"
        >
          <template slot="items" slot-scope="props">
            <td>{{ props.item.id }}</td>
            <td class="text-xs-left">{{ props.item.fullUrl }}</td>
            <td class="text-xs-left">localhost:8000/{{ props.item.short }}</td>
          </template>
        </v-data-table>
      </v-flex>
      <v-flex xs12 md3></v-flex>
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




