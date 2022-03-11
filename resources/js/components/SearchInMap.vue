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
            map: [],
            markers: [] // array segnalini
        }
    },

    methods: {

        // creazione mappa
        getMap() {
            this.map = this.tt.map({
                key: this.apiKey,
                container: 'map',
                center: this.center,
                zoom: 12,
                language: 'it-IT'
            });

            // aggiunta controlli mappa
            this.map.addControl(new this.tt.FullscreenControl()); 
            this.map.addControl(new this.tt.NavigationControl());

            // aggiunta segnalini per ogni appartamento trovato
            // this.addMarker(map);
        },

        // metodo per aggiungere segnalino su mappa con fumetto indirizzo
        addMarker() { 

            this.clearMarkers();

            this.apartmentsFound.forEach(ele => {

                let popupOffset = 25; 
                let marker = new this.tt.Marker().setLngLat(ele).addTo(this.map); 
                this.markers.push(marker);
                let popup = new this.tt.Popup({ offset: popupOffset }); 
                this.reverseGeocoding(marker, popup); 
                marker.setPopup(popup); 
            })
        },

        // metodo per rimuovere segnalini dalla mappa
        clearMarkers() {
            this.markers.forEach(ele => {
                ele.remove();
            });
            this.markers = [];
        },

        // sposta la mappa nella zona della ricerca
        moveMap() {
            this.map.flyTo({
                center: this.center,
                zoom: 12
            })
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
  height: 100vh;
  width: 100% - 15px;
}
</style>