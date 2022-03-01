<template>
    <div>

        <!-- lista appartamenti dell'utenete loggato -->
        <ul>
            <li v-for="apartment, i in apartmentsList" :key="`apartment-${i}`">
                <a :href="`/apartment/show/${apartment.id}`">
                    {{ apartment.title }}
                </a>
                <a :href="`/apartment/edit/${apartment.id}`" class="btn btn-primary">Edit</a>
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

