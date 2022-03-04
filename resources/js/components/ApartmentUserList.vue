<template>
    <div class="container">
        <!-- lista appartamenti dell'utente loggato -->
        <div class="row justify-content-center ">
            <ul>
                <li class="list-unstyled d-flex align-items-center" v-for="apartment, i in apartmentsList" :key="`apartment-${i}`">
                    <div class="col-9">
                        <h3 class="m-3">
                            <a class="text-decoration-none" :href="`/apartment/show/${apartment.id}`">
                                <i class="fas fa-home"></i>
                                {{ apartment.title }}
                            </a>
                        </h3>
                    </div>
                    <div class="col-6">
                        <a :href="`/apartment/edit/${apartment.id}`" class="btn btn-blue mr-2">Edit</a>
                        <a :href="`/apartment/delete/${apartment.id}`" class="btn btn-red">Delete</a>
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
            apartmentsList: []
        }
    },

    methods: {

    // lista appartamenti dell'utenete loggato
        getApartmentUserList() {
            axios
            .get(`/api/user/apartments/list`)
            .then(r => this.apartmentsList = r.data)
            .catch(e => console.error(e));
        }
    },

    mounted() {
        console.log('component mounted');
        this.getApartmentUserList();
    }
}
</script>

