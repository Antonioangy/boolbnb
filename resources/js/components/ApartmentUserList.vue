<template>
    <div>

        <!-- lista appartamenti dell'utenete loggato -->
        <ul>
            <li v-for="apartment, i in apartmentsList" :key="`apartment-${i}`">
                {{ apartment.title }}
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

