<template>
    <div id="map">

    </div>
</template>

<script>
export default {

    name: 'SearchInMap',
    props: {

        // prendo le coordinate della ricerca per spostare la mappa
        center: Array,

        // prendo coordinate degli appartamenti trovati
        apartmentsFound: Array
    },
    
    data() {
        return {
            apiKey: 'CCNCApHEo3ZS5ewtvHkSDu7hMeAY7sQc', //tua key personale da developer.tomtom
            tt: window.tt,
            coordinates: [12.395915,41.9102415],
        }
    },

    methods: {

        // creazione mappa
        getMap() {
            let map = this.tt.map({
                key: this.apiKey,
                container: 'map',
                center: this.center,
                zoom: 12,
                language: 'it-IT'
            });

            // aggiunta controlli mappa
            map.addControl(new this.tt.FullscreenControl()); 
            map.addControl(new this.tt.NavigationControl());

            // aggiunta segnalini per ogni appartamento trovato
            this.apartmentsFound.forEach(ele => {
                console.log(ele);
                this.addMarker(map, ele);
            })
        },

        // metodo per aggiungere segnalino su mappa con fumetto indirizzo
        addMarker(map, coordinates) { 
            let popupOffset = 25; 
        
            var marker = new this.tt.Marker().setLngLat(coordinates).addTo(map); 
            var popup = new this.tt.Popup({ offset: popupOffset }); 
            this.reverseGeocoding(marker, popup); 
            marker.setPopup(popup); 
        },

        // metodo calcolo indirizzo da coordinate 
        reverseGeocoding(marker, popup) { 
            this.tt.services.reverseGeocode({ 
            key: 'iTF86GRA2V5iGjM6LMMV54lrK8v6zC1w', 
            position: marker.getLngLat() 
            })
            .then( function( result ){ 
            popup.setHTML(result.addresses[0].address.freeformAddress); 
            }) 
        }
    },

    mounted() {
        this.getMap();
    }

}
</script>

<style>
#map {
  height: 100%;
  width: 100%;
}
</style>