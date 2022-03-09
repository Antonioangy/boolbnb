<template>
    <div class="container">
        <!-- lista appartamenti dell'utente loggato -->
        <div>
            <ul>
                <li class="list-unstyled d-flex align-items-center justify-content-between row" v-for="apartment, i in apartmentsList" :key="`apartment-${i}`">
                    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12">
                        <div class="d-flex justify-content-between">
                            <h3 class="m-3">
                                <a v-if="!apartment.sponsor" class="text-decoration-none" :href="`/apartment/show/${apartment.id}`">
                                    <i class="fa-solid fa-star invisible"></i>
                                    <i class="fas fa-home"></i>
                                    {{ apartment.title }}
                                </a>
                                <a v-else class="text-decoration-none" :href="`/apartment/show/${apartment.id}`">
                                    <i class="fa-solid fa-star text-orange"></i>
                                    <i class="fas fa-home"></i>
                                    {{ apartment.title }} 
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                        <div>
                            <a :href="`/apartment/edit/${apartment.id}`" class="btn btn-blue mt-md-2 mt-sm-2">Modifica</a> 

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-red mt-md-2 mt-sm-2" data-toggle="modal" data-target="#confirmDelete" @click="saveId(apartment.id)">
                                Cancella
                            </button>
                            
                            <a v-if="!apartment.sponsor" :href="`/apartment/sponsor/${apartment.id}`" class="btn btn-darkBlue mt-md-2 mt-sm-2">Sponsorizza</a>
                            <a v-else :href="`/apartment/sponsor/${apartment.id}`" class="btn btn-darkBlue mt-md-2 mt-sm-2">Estendi sponsor</a>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <i class="fa-solid fa-circle-exclamation text-red m-auto h1"></i>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Confermi di voler eliminare questo elemento?</h5>
                                    </div>
                                    <div class="modal-footer">
                                        <a :href="`/apartment/delete/${savedId}`" class="btn btn-red">Conferma</a>
                                        <button type="button" class="btn btn-grey" data-dismiss="modal">Chiudi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ApartmentUserList',
    
    data() {
        return {
            apartmentsList: [],
            savedId: 0
        }
    },

    methods: {

    // lista appartamenti dell'utenete loggato
        getApartmentUserList() {
            axios
            .get(`/api/user/apartments/list`)
            .then(r => this.apartmentsList = r.data)
            .catch(e => console.error(e));
        },

        saveId(id) {
            this.savedId = id;
        },
    },

    mounted() {
        console.log('component mounted');
        this.getApartmentUserList();
    }
}
</script>

