<template>
  <div id="mobil">
  
    
    <b-alert variant="success" show v-if="showMessage">{{ dataMessage }}</b-alert>
  
    <b-row>
  
  
  
      <b-col lg="2" class="pb-2">
  
  
  
        <b-button variant="outline-primary" pull="left" v-b-modal.modalPrevent>
  
  
  
          <font-awesome-icon icon="plus" pull="left" /> Tambah Mobil</b-button>
  
  
  
        <!-- <b-button size="sm">Small Button</b-button></b-col> -->
  
  
  
      </b-col>
  
  
  
    </b-row>
  
  
  
    <table class="table table-hover">
  
      <thead>
  
        <tr>
  
          <th scope="col">ID</th>
  
          <th scope="col">No Stnk</th>
  
          <th scope="col">Merk</th>
  
          <th scope="col">Jenis</th>
  
          <th scope="col">Warna</th>
  
          <th scope="col">Tahun Buat</th>
  
          <th scope="col">Tarif Perhari</th>
  
          <th scope="col">Aksi</th>
  
          <th></th>
  
        </tr>
  
      </thead>
  
      <tbody>
  
        <tr v-for="(mobil, index) in dataMobil" :key="index">
  
          <td>{{ mobil.id }}</td>
  
          <td>{{ mobil.no_stnk }}</td>
  
          <td>{{ mobil.merk }}</td>
  
          <td>{{ mobil.jenis }}</td>
  
          <td>{{ mobil.warna }}</td>
  
          <td>{{ mobil.tahun_buat }}</td>
  
          <td>{{ mobil.tarif_perhari }}/24hr</td>
  
          <td>
  
            <button type="button" class="btn btn-warning btn-sm" v-b-modal.book-update-modal @click="editMobil(mobil)">Update</button>
  
            <button type="button" class="btn btn-danger btn-sm" @click="deleteRow(mobil.id)">Delete</button>
  
          </td>
  
        </tr>
  
      </tbody>
  
    </table>


    <b-modal
      id="modalPrevent"
      ref="modal"
      title="Tambah Mobil"
      @ok="handleOk"
      @shown="clearName"
    >
      <form @submit.stop.prevent="handleSubmit" style="margin:2px;">
        <b-form-input type="text" placeholder="No Stnk" v-model="mobil.no_stnk" />
        <b-form-input type="text" placeholder="Merk" v-model="mobil.merk" />
        <b-form-input type="text" placeholder="Jenis" v-model="mobil.jenis" />
        <b-form-input type="text" placeholder="Warna" v-model="mobil.warna" />
        <b-form-input type="text" placeholder="Tahun Buat" v-model="mobil.tahun_buat" />
        <b-form-input type="text" placeholder="Tarif Perhari" v-model="mobil.tarif_perhari" />
      </form>
    </b-modal>

    <b-modal
      title="Sunting Mobil"
      ref="editBookModal"
      id="book-update-modal"
      @ok="handleEditOk"
    >
      <form @submit.stop.prevent="handleEdit" style="margin:2px;">
        <b-form-input type="text" placeholder="No Stnk" v-model="mobils.no_stnk" />
        <b-form-input type="text" placeholder="Merk" v-model="mobils.merk" />
        <b-form-input type="text" placeholder="Jenis" v-model="mobils.jenis" />
        <b-form-input type="text" placeholder="Warna" v-model="mobils.warna" />
        <b-form-input type="text" placeholder="Tahun Buat" v-model="mobils.tahun_buat" />
        <b-form-input type="text" placeholder="Tarif Perhari" v-model="mobils.tarif_perhari" />
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

        dataMobil: [],

        mobils: '',

        mobil: {
          name: '',
          no_stnk: '',
          merk: '',
          jenis: '',
          warna: '',
          tahun_buat: '',
          tarif_perhari: '',
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
        api.get('/mobil/' + id).then(res => {
          this.mobil = res.data.result
        })
      }

      this.get()

    },
  
    methods: {
      deleteRow(id) {
        api.delete('mobil/' + id).then(res => {
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
  
        api.get('mobil').then(res => {
  
          if (res.data.status == 'sukses') {
  
            this.dataMobil = res.data.result;
  
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
        if (!this.mobil.name && !this.mobil.n_stnk && !this.mobil.merk && !this.mobil.jenis && !this.mobil.warna && !this.mobil.t_buat && !this.mobil.t_hari) {
          alert('Silahkan lengkapi data')
        } else {
          this.handleSubmit()
        }
      },
      handleSubmit() {
        let data = this.mobil;
        let url = "mobil"

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
      editMobil(mobil) {
        this.mobils = mobil;
      },
      handleEdit() {
        let data = this.mobils;
        let url = "mobil"

        if(this.mobils.id) {
          url += '/' + this.mobils.id
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
  #mobil {
  
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
