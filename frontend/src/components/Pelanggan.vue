<template>
  <div id="pelanggan">
  
    
    <b-alert variant="success" show v-if="showMessage">{{ dataMessage }}</b-alert>
  
    <b-row>
  
  
  
      <b-col lg="2" class="pb-2">
  
  
  
        <b-button variant="outline-primary" pull="left" v-b-modal.modalPrevent>
  
  
  
          <font-awesome-icon icon="plus" pull="left" /> Tambah Pelanggan</b-button>
  
  
  
        <!-- <b-button size="sm">Small Button</b-button></b-col> -->
  
  
  
      </b-col>
  
  
  
    </b-row>
  
  
  
    <table class="table table-hover">
  
      <thead>
  
        <tr>
  
          <th scope="col">ID</th>
  
          <th scope="col">NIK</th>
  
          <th scope="col">Nama</th>
  
          <th scope="col">Alamat</th>
  
          <th scope="col">Tanggal Lahir</th>
  
          <th scope="col">No Telp</th>
  
          <th scope="col">Jenkel</th>
  
          <th scope="col">Aksi</th>
  
          <th></th>
  
        </tr>
  
      </thead>
  
      <tbody>
  
        <tr v-for="(pelanggan, index) in dataPelanggan" :key="index">
  
          <td>{{ pelanggan.id }}</td>
  
          <td>{{ pelanggan.nik }}</td>
  
          <td>{{ pelanggan.nama }}</td>
  
          <td>{{ pelanggan.alamat }}</td>
  
          <td>{{ pelanggan.tanggal_lahir }}</td>
  
          <td>{{ pelanggan.no_telp }}</td>
  
          <td>{{ pelanggan.jenkel }}</td>
  
          <td>
  
            <button type="button" class="btn btn-warning btn-sm" v-b-modal.book-update-modal @click="editPelanggan(pelanggan)">Update</button>
  
            <button type="button" class="btn btn-danger btn-sm" @click="deleteRow(pelanggan.id)">Delete</button>
  
          </td>
  
        </tr>
  
      </tbody>
  
    </table>


    <b-modal
      id="modalPrevent"
      ref="modal"
      title="Tambah pelanggan"
      @ok="handleOk"
      @shown="clearName"
    >
      <form @submit.stop.prevent="handleSubmit" style="margin:2px;">
        <b-form-input type="text" placeholder="NIK" v-model="pelanggan.nik" />
        <b-form-input type="text" placeholder="Nama" v-model="pelanggan.nama" />
        <b-form-input type="text" placeholder="Alamat" v-model="pelanggan.alamat" />
        <b-form-input type="text" placeholder="Tanggal Lahir" v-model="pelanggan.tanggal_lahir" />
        <b-form-input type="text" placeholder="No Telp" v-model="pelanggan.no_telp" />
        <b-form-input type="text" placeholder="Jenkel" v-model="pelanggan.jenkel" />
      </form>
    </b-modal>

    <b-modal
      title="Sunting Pelanggan"
      ref="editBookModal"
      id="book-update-modal"
      @ok="handleEditOk"
    >
      <form @submit.stop.prevent="handleEdit" style="margin:2px;">
        <b-form-input type="text" placeholder="NIK" v-model="pelanggans.nik" />
        <b-form-input type="text" placeholder="Nama" v-model="pelanggans.nama" />
        <b-form-input type="text" placeholder="Alamat" v-model="pelanggans.alamat" />
        <b-form-input type="text" placeholder="Tanggal Lahir" v-model="pelanggans.tanggal_lahir" />
        <b-form-input type="text" placeholder="No Telp" v-model="pelanggans.no_telp" />
        <b-form-input type="text" placeholder="Jenkel" v-model="pelanggans.jenkel" />
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

        dataPelanggan: [],

        pelanggans: '',

        pelanggan: {
          nik: '',
          nama: '',
          alamat: '',
          tanggal_lahir: '',
          no_telp: '',
          jenkel: ''
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
        api.get('/pelanggan/' + id).then(res => {
          this.pelanggan = res.data.result
        })
      }

      this.get();

    },
  
    methods: {
      deleteRow(id) {
        api.delete('pelanggan/' + id).then(res => {
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

        api.get('pelanggan').then(res => {
  
          if (res.data.status == 'sukses') {
  
            this.dataPelanggan = res.data.result;
  
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
        if (!this.pelanggan.nik && !this.pelanggan.nama && !this.pelanggan.alamat && !this.pelanggan.tanggal_lahir && !this.pelanggan.no_telp && !this.pelanggan.jenkel) {
          alert('Silahkan lengkapi data')
        } else {
          this.handleSubmit()
        }
      },
      handleSubmit() {
        let data = this.pelanggan;
        let url = "pelanggan"

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
      editPelanggan(pelanggan) {
        this.pelanggans = pelanggan;
      },
      handleEdit() {
        let data = this.pelanggans;
        let url = "pelanggan"

        if(this.pelanggans.id) {
          url += '/' + this.pelanggans.id
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
  #pelanggan {
  
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
