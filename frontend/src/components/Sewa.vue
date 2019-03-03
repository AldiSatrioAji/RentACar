<template>
  <div id="sewa">
  
    
    <b-alert variant="success" show v-if="showMessage">{{ dataMessage }}</b-alert>
  
    <b-row>
  
  
  
      <b-col lg="2" class="pb-2">
  
  
  
        <b-button variant="outline-primary" pull="left" v-b-modal.modalPrevent>
  
  
  
          <font-awesome-icon icon="plus" pull="left" /> Tambah sewa</b-button>
  
  
  
        <!-- <b-button size="sm">Small Button</b-button></b-col> -->
  
  
  
      </b-col>
  
  
  
    </b-row>
  
  
  
    <table class="table table-hover">
  
      <thead>
  
        <tr>
  
          <th scope="col">ID Sewa</th>
  
          <th scope="col">Nik</th>
  
          <th scope="col">ID Admin</th>
  
          <th scope="col">No Stnk</th>
  
          <th scope="col">Tanggal Peminjaman</th>
  
          <th scope="col">Tanggal Pengembalian</th>
  
          <th scope="col">Total Tarif</th>

          <th scope="col">Aksi</th>
  
          <th></th>
  
        </tr>
  
      </thead>
  
      <tbody>
  
        <tr v-for="(sewa, index) in datasewa" :key="index">
  
          <td>{{ sewa.id }}</td>
  
          <td>{{ sewa.nik }}</td>
  
          <td>{{ sewa.id_admin }}</td>
  
          <td>{{ sewa.no_stnk }}</td>
  
          <td>{{ sewa.tanggal_peminjaman }}</td>
  
          <td>{{ sewa.tanggal_pengembalian }}</td>
  
          <td>{{ sewa.total_tarif }}</td>
  
          <td>
  
            <button type="button" class="btn btn-warning btn-sm" v-b-modal.book-update-modal @click="editsewa(sewa)">Update</button>
  
            <button type="button" class="btn btn-danger btn-sm" @click="deleteRow(sewa.id)">Delete</button>
  
          </td>
  
        </tr>
  
      </tbody>
  
    </table>


    <b-modal
      id="modalPrevent"
      ref="modal"
      title="Tambah sewa"
      @ok="handleOk"
      @shown="clearName"
    >
      <form @submit.stop.prevent="handleSubmit" style="margin:2px;">
        <b-form-input type="text" placeholder="NIK" v-model="sewa.nik" />
        <b-form-input type="text" placeholder="ID Admin" v-model="sewa.id_admin" />
        <b-form-input type="text" placeholder="No Stnk" v-model="sewa.no_stnk" />
        <b-form-input type="text" placeholder="Tanggal Peminjaman" v-model="sewa.tanggal_peminjaman" />
        <b-form-input type="text" placeholder="Tanggal Pengembalian" v-model="sewa.tanggal_pengembalian" />
        <b-form-input type="text" placeholder="Total Tarif" v-model="sewa.total_tarif" />
      </form>
    </b-modal>

    <b-modal
      title="Sunting sewa"
      ref="editBookModal"
      id="book-update-modal"
      @ok="handleEditOk"
    >
      <form @submit.stop.prevent="handleEdit" style="margin:2px;">
        <b-form-input type="text" placeholder="NIK" v-model="sewas.nik" />
        <b-form-input type="text" placeholder="ID Admin" v-model="sewas.id_admin" />
        <b-form-input type="text" placeholder="No Stnk" v-model="sewas.no_stnk" />
        <b-form-input type="text" placeholder="Tanggal Peminjaman" v-model="sewas.tanggal_peminjaman" />
        <b-form-input type="text" placeholder="Tanggal Pengembalian" v-model="sewas.tanggal_pengembalian" />
        <b-form-input type="text" placeholder="Total Tarif" v-model="sewas.total_tarif" />
      </form>
    </b-modal>
  
  </div>
</template>

<script>
  import {
  
    api
  
  } from '@/helper/api'
  
  export default {
  
    data() {
  
      return {
        dataMessage: '',
        showMessage: false,

        datasewa: [],

        sewas: '',

        sewa: {
          nik: '',
          id_admin: '',
          no_stnk: '',
          tanggal_peminjaman: '',
          tanggal_pengembalian: '',
          total_tarif: ''
        },
  
        fields: {
  
          id: {
  
            label: 'ID',
  
            sortable: true
  
          },
  
          no_stnk: {
  
            label: 'NO STNK',
  
            sortable: false
  
          },
  
          merk: {
  
            label: 'Merk',
  
            sortable: true
  
          },
  
          jenis: {
  
            label: 'Jenis',
  
            sortable: true
  
          },
  
          warna: {
  
            label: 'Warna',
  
            sortable: true
  
          },
  
          tahun_buat: {
  
            label: 'Tahun Buat',
  
            sortable: true
  
          },
  
          tarif_perhari: {
  
            label: 'Tarif Perhari',
  
            sortable: true
  
          },
  
          city: {
  
            key: 'address.city',
  
            sortable: true
  
          },
  
          'address.country': {
  
            label: 'Country',
  
            sortable: true
  
          }
  
        },
  
        items: [{
  
            isActive: true,
  
            age: 40,
  
            first_name: 'Dickerson',
  
            last_name: 'Macdonald',
  
            address: {
  
              country: 'USA',
  
              city: 'New York'
  
            }
  
          },
  
          {
  
            isActive: false,
  
            age: 21,
  
            first_name: 'Larsen',
  
            last_name: 'Shaw',
  
            address: {
  
              country: 'Canada',
  
              city: 'Toronto'
  
            }
  
          },
  
          {
  
            isActive: false,
  
            age: 89,
  
            first_name: 'Geneva',
  
            last_name: 'Wilson',
  
            address: {
  
              country: 'Australia',
  
              city: 'Sydney'
  
            }
  
          },
  
          {
  
            isActive: true,
  
            age: 38,
  
            first_name: 'Jami',
  
            last_name: 'Carney',
  
            address: {
  
              country: 'England',
  
              city: 'London'
  
            }
  
          }
  
        ]
  
      }
  
    },
  
    mounted() {

      let id = this.$route.params.id

      if(id) {
        api.get('/sewa/' + id).then(res => {
          this.sewa = res.data.result
        })
      }

      this.get();

    },
  
    methods: {
      deleteRow(id) {
        api.delete('sewa/' + id).then(res => {
          if(res.data.status == 'sukses') {
            this.get();
            this.showMessage = true;
            this.dataMessage = "Data berhasil dihapus!";
          } else {
            console.log(res.data.message);
          }
        }).catch(err => {
          console.log(err);
        })
      },
  
      get() {

        api.get('sewa').then(res => {
  
          if (res.data.status == 'sukses') {
  
            this.datasewa = res.data.result;
  
          } else {
  
            console.log(res.data.message);
  
          }
  
        }).catch(err => {
  
          console.log(err);
  
        })
  
      },
      clearName() {
        this.name = ''
      },
      handleOk(evt) {
        // Prevent modal from closing
        evt.preventDefault()
        if (!this.sewa.nik && !this.sewa.nama && !this.sewa.alamat && !this.sewa.tanggal_lahir && !this.sewa.no_telp && !this.sewa.jenkel) {
          alert('Silahkan lengkapi data')
        } else {
          this.handleSubmit()
        }
      },
      handleSubmit() {
        let data = this.sewa;
        let url = "sewa"

        api.post(url, data).then(res => {
          if(res.data.status == 'sukses') {
            this.get();
            this.showMessage = true;
            this.dataMessage = "Data berhasil ditambah!";
          } else {
            console.log(res.data.message)
          }
        }).catch(err => {
          console.log(err);
        })
      },
      editsewa(sewa) {
        this.sewas = sewa;
      },
      handleEdit() {
        let data = this.sewas;
        let url = "sewa";

        if(this.sewas.id) {
          url += '/' + this.sewas.id
        }

        api.post(url, data).then(res => {
          if(res.data.status == 'sukses') {
            this.get();
            this.showMessage = true;
            this.dataMessage = "Data berhasil diubah!";
          } else {
            console.log(res.data.message)
          }
        }).catch(err => {
          console.log(err);
        })
      },
      handleEditOk(evt) {
        this.handleEdit();
      }
    }
  
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  #sewa {
  
    margin: 10px;
  
  }
  
  
  
  h1,
  
  h2 {
  
    font-weight: normal;
  
  }
  
  
  
  ul {
  
    list-style-type: none;
  
    padding: 0;
  
  }
  
  
  
  li {
  
    display: inline-block;
  
    margin: 0 10px;
  
  }
  
  
  
  a {
  
    color: #42b983;
  
  }
</style>
