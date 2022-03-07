<template>
    <div id="map">

    </div>
</template>

<script>
export default {

    name: 'SearchInMap',
    props: {
        // prendo le cordinate dell ricerca per spostare la mappas
        center: Array
    },
    
    data() {
        return {
            apiKey: 'CCNCApHEo3ZS5ewtvHkSDu7hMeAY7sQc', //tua key personale da developer.tomtom
            tt: window.tt,
            coordinates: [12.395915,41.9102415],
        }
    },

    methods: {

        getMap() {
            let map = this.tt.map({
                key: this.apiKey,
                container: 'map',
                center: this.center,
                zoom: 13,
                language: 'it-IT'
            });
            map.addControl(new this.tt.FullscreenControl()); 
            map.addControl(new this.tt.NavigationControl());
            // this.addMarker(map, this.center);
            // this.search(map);
        },

        // search(map) {

        //     // tt.services.geometrySearch({s
        //     //     key: this.apiKey,
        //     //     geometryList: this.geometryList,
        //     //     query: 'pizzeria',
        //     //     // idxSet: 'PAD,Addr'
        //     // }).then(r => console.log(r));

        //     tt.services.nearbySearch({
        //         key: this.apiKey,
        //         center: this.coordinates,
        //         radius: 20000,
        //         limit: 30,
        //         }).then(r => {
        //             r.results.forEach(element => {
        //                 // console.log(element.position)
        //                 let position = element.position;
        //                 this.addMarker(map, position);
        //             });
        //         });
        // },

        addMarker(map, coordinates) { 
            let popupOffset = 25; 
        
            var marker = new this.tt.Marker().setLngLat(coordinates).addTo(map); 
            var popup = new this.tt.Popup({ offset: popupOffset }); 
            this.reverseGeocoding(marker, popup); 
            marker.setPopup(popup); 
        },

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
        // this.search();
        console.log('component mounted');
    }

}
</script>

<style>
#map {
  height: 100%;
  width: 100%;
}
</style>