<template>
    <div id="map"></div>
</template>

<script>
// fonte https://developer.tomtom.com/blog/build-different/using-tomtom-maps-vue-3

export default {
    name: 'Map',
    props: {

        // predo le coordinate dell'appartamento
        lng: Number,
        lat: Number,
    },

    data() {
        return {
            apiKey: 'CCNCApHEo3ZS5ewtvHkSDu7hMeAY7sQc', //tua key personale da developer.tomtom
            tt: window.tt,
            coordinates: [this.lng,this.lat],
        }
    },

    methods: {

        // genero mappa con al centro la posizione dell'appartamento
        getMap() {
            let map = this.tt.map({
                key: this.apiKey,
                container: 'map',
                center: this.coordinates,
                zoom: 14,
                language: 'IT'
            });
            map.addControl(new this.tt.FullscreenControl()); 
            map.addControl(new this.tt.NavigationControl());
            this.addMarker(map);
        },

        // aggiungo il segnalino sulla mappa
        addMarker(map) { 
            // let popupOffset = 25; 
        
            var marker = new this.tt.Marker().setLngLat(this.coordinates).addTo(map); 
            // var popup = new this.tt.Popup({ offset: popupOffset }); 
            // this.reverseGeocoding(marker, popup); 
            // marker.setPopup(popup).togglePopup(); 
        }, 

        // indirizzo da coordinate con popup
        // reverseGeocoding(marker, popup) { 
        //     this.tt.services.reverseGeocode({ 
        //     key: 'iTF86GRA2V5iGjM6LMMV54lrK8v6zC1w', 
        //     position: marker.getLngLat() 
        //     })
        //     .then( function( result ){ 
        //     popup.setHTML(result.addresses[0].address.freeformAddress); 
        //     }) 
        // }
    },

    mounted() {
        this.getMap();
    }
}
</script>

<style lang="scss" scoped>
#map {
  aspect-ratio: 2 / 1;
  width: 100%;
}
</style>