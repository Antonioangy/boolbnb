<template>
    <div id="map">

    </div>
</template>

<script>
export default {

    name: 'SearchInMap',
    data() {
        return {
            apiKey: 'CCNCApHEo3ZS5ewtvHkSDu7hMeAY7sQc', //tua key personale da developer.tomtom
            tt: window.tt,
            coordinates: [12.395915,41.9102415],
            geometryList: [
                // {
                //     type: 'POLYGON',
                //     vertices: [
                //     '37.7524152343544,-122.43576049804686',
                //     '37.70660472542312,-122.43301391601562',
                //     '37.712059855877314,-122.36434936523438',
                //     '37.75350561243041,-122.37396240234374'
                //     ]
                // },
                // {
                //     type: 'CIRCLE',
                //     position: '37.71205,-121.36434',
                //     radius: 6000
                // },
                {
                    type: 'CIRCLE',
                    position: '12.395915,41.9102415',
                    radius: 20000
                }
            ]
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
            this.addMarker(map, this.coordinates);
            this.search(map);
        },

        search(map) {

            // tt.services.geometrySearch({s
            //     key: this.apiKey,
            //     geometryList: this.geometryList,
            //     query: 'pizzeria',
            //     // idxSet: 'PAD,Addr'
            // }).then(r => console.log(r));

            tt.services.nearbySearch({
                key: this.apiKey,
                center: this.coordinates,
                radius: 20000,
                limit: 30,
                }).then(r => {
                    r.results.forEach(element => {
                        // console.log(element.position)
                        let position = element.position;
                        this.addMarker(map, position);
                    });
                });
        },

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
            // console.log(result.addresses[0].address.freeformAddress); 
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
  height: 50vh;
  width: 50vw;
}
</style>