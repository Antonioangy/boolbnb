<template>
    <div id="map"></div>
</template>

<script>
// fonte https://developer.tomtom.com/blog/build-different/using-tomtom-maps-vue-3

export default {
    name: 'Map',
    props: {
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

        addMarker(map) { 
            let popupOffset = 25; 
        
            var marker = new this.tt.Marker().setLngLat(this.coordinates).addTo(map); 
            var popup = new this.tt.Popup({ offset: popupOffset }); 
            this.reverseGeocoding(marker, popup); 
            marker.setPopup(popup).togglePopup(); 
        },

        reverseGeocoding(marker, popup) { 
            this.tt.services.reverseGeocode({ 
            key: 'iTF86GRA2V5iGjM6LMMV54lrK8v6zC1w', 
            position: marker.getLngLat() 
            })
            .then( function( result ){ 
            console.log(result.addresses[0].address.freeformAddress); 
            popup.setHTML(result.addresses[0].address.freeformAddress); 
            }) 
        }
    },

    mounted() {
        console.log('map mounted');
        this.getMap();
        
    }
}
</script>

<style lang="scss" scoped>
#map {
  height: 50vh;
  width: 50vw;
}
</style>