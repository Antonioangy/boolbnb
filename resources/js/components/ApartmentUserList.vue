<template>
    <div>

        <!-- lista appartamenti dell'utenete loggato -->
        <ul>
            <li class="list-unstyled d-flex" v-for="apartment, i in apartmentsList" :key="`apartment-${i}`">
                <h3 class="mr-3">
                    <a :href="`/apartment/show/${apartment.id}`">
                    <i class="fas fa-home"></i>
                    {{ apartment.title }}
                </a>
                </h3>
                
                <a :href="`/apartment/edit/${apartment.id}`" class="btn btn-primary mr-2">Edit</a>
                <a :href="`/apartment/delete/${apartment.id}`" class="btn btn-danger">Delete</a>
            </li>
        </ul>
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

