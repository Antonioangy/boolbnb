<template>
    <div class="container my-5">
        <!-- lista appartamenti dell'utente loggato -->
        <div>
            <ul>
                <li class="userApartment list-unstyled my-2 d-flex align-items-center justify-content-between row" v-for="apartment, i in apartmentsList" :key="`apartment-${i}`">
                    <div class="apartmentInfos col-xl-8 col-lg-6 col-md-6 col-sm-12">
                        <a v-if="!apartment.sponsor" class="text-decoration-none d-flex align-items-center" :href="`/apartment/show/${apartment.id}`">
                            <i class="fa-solid fa-star invisible"></i>

                            <div v-if="apartment.images" class="userApartmentImg">
                                <img class="rounded" :src="`/storage/assets/${apartment.images}`" alt="">
                            </div>
                            <div v-else class="userApartmentImg d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-house-chimney h1"></i>
                            </div>

                            <h3 class="userApartmentTitle pl-5 text-darkBlue">
                                {{ apartment.title }}
                            </h3>
                            
                            <div>{{ $views }} views</div>
                        </a>
                        <a v-else class="text-decoration-none d-flex align-items-center" :href="`/apartment/show/${apartment.id}`">

                            <i class="fa-solid fa-star text-orange"></i>

                            <div v-if="apartment.images" class="userApartmentImg">
                                <img class="border border-orange rounded" :src="`/storage/assets/${apartment.images}`" alt="">
                            </div>
                            <div v-else class="userApartmentImg d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-house-chimney h4"></i>
                            </div>

                            <h3 class="userApartmentTitle pl-5 text-orange">
                                {{ apartment.title }}
                            </h3>

                            <div>{{ views }} views</div>
                        </a>
                    </div>
                    
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="text-center apartmentButtons py-2">
                            <a :href="`/apartment/edit/${apartment.id}`" class="btn btn-blue">Modifica</a>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-red" data-toggle="modal" data-target="#confirmDelete" @click="saveId(apartment.id)">
                                Cancella
                            </button>
                            
                            <a v-if="!apartment.sponsor" :href="`/apartment/sponsor/${apartment.id}`" class="btn btn-darkBlue">Sponsorizza</a>
                            <a v-else :href="`/apartment/sponsor/${apartment.id}`" class="btn btn-darkBlue">Estendi sponsor</a>
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
    props: {
        views: String,
    },
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

