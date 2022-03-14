<template>
    <div class="shadow p-3 my-3 bg-white rounded">
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>
</template>

<script>
import Chart from 'chart.js/auto';

export default {
    data() {
        return {
            apartmentsList: [],
            apartmentsName: [],
            apartmentViews: [],
        }
    },
    methods: {
        getApartmentData() {
            axios.get(`/api/user/apartments/list`)
                .then(r => {
                    this.apartmentsList = r.data;
                    this.apartmentsList.forEach(apartment => {
                        this.apartmentsName.push(apartment.title);
                    });

                    this.chart();
                })
                .catch(e => console.error(e));
            
        },
        getApartmentViews() {
            axios.get(`/api/user/apartments/views`)
                .then(r => {
                    let data = r.data;
                    this.apartmentViews = data;
                })
                .catch(e => console.error(e));
        },
        chart() {
            const ctx = document.getElementById('myChart');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.apartmentsName,
                    datasets: [{
                        label: 'n. di Visualizzazioni',
                        data: this.apartmentViews,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 206, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(153, 102, 255)',
                            'rgb(255, 159, 64)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 134, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    },
    mounted() {
        this.getApartmentViews()
        this.getApartmentData()
    }
}
</script>