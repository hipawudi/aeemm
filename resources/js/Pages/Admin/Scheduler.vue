<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                排課
            </h2>
        </template>
        {{ offer }}
        <table border="1" width="100%">
            <tr>
                <td v-for="week in weekTable">
                    <a-checkbox v-model:checked="week.selected" @change="onChangeWeek">{{ week.label }}</a-checkbox>
                    <a-select v-model:value="week.room_type" :options="roomTypes"/>
                    <a-input type="time" v-model:value="week.start_time" />
                    <a-input type="time" v-model:value="week.end_time" />
                </td>
            </tr>
        </table>
        <a-button @click="getDays">List all dates</a-button>
        <table border="1" width="100%">
            <tr>
                <td v-for="week in weekTable">
                    {{ week.label }}
                </td>
            </tr>
            <tr>
                <td v-for="week in weekTable">
                    <span v-for="w in week.list">
                        {{ w.date }}<br/>
                    </span>
                </td>
            </tr>
        </table>
        <a-button @click="checkAvailableRooms" :disabled='plantedDates.length<=0'>Check Available Rooms</a-button>
        <table v-if="Object.entries(availableRooms).length>0" width="100%">
            <tr>
                <td>Time</td>
                <td v-for="room in availableRooms.rooms" >
                    <a-checkbox @change="onSelectRoomColumn(room)" v-model:checked="room.checkAll"/>
                    {{ room.code }}
                </td>
            </tr>
            <tr v-for="d in availableRooms.selectedDates">
                <td>{{ d.start_time }}</td>
                <td v-for="room in availableRooms.rooms">
                    <a-checkbox @change="selectRoom(d,room)"/>
                </td>
            </tr>
        </table>
    </AdminLayout>

</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { defineComponent, reactive } from 'vue';

export default {
    components: {
        AdminLayout,
    },
    props: ['offer'],
    data() {
        return {
            dateFormat:'YYYY-MM-DD',
            weekTable: [
                {'value':'0','label':'Monday','selected':false,'room_type':'REG','start_time':'09:00','end_time':'10:00','list':[]},
                {'value':'1','label':'Tuesday','selected':false,'room_type':'REG','start_time':'09:00','end_time':'10:00','list':[]},
                {'value':'2','label':'Wednesday','selected':false,'room_type':'REG','start_time':'09:00','end_time':'10:00','list':[]},
                {'value':'3','label':'Thursday','selected':false,'room_type':'REG','start_time':'09:00','end_time':'10:00','list':[]},
                {'value':'4','label':'Friday','selected':false,'room_type':'REG','start_time':'09:00','end_time':'10:00','list':[]},
                {'value':'5','label':'Saturday','selected':false,'room_type':'REG','start_time':'09:00','end_time':'10:00','list':[]},
                {'value':'6','label':'Sunday','selected':false,'room_type':'REG','start_time':'09:00','end_time':'10:00','list':[]}
            ],
            months: ['January','February','March','April','May','June','July','August','September','October','November','December'],
            plantedDates:[],
            roomTypes:[
                {'value':'REG','label':'一般課室'},
                {'value':'COM','label':'電腦室'}
            ],
            availableRooms:{}
        }
    },
    methods: {
        onSelectRoomColumn(room){
            console.log(this.availableRooms.selectedDates);
            this.availableRooms.selectedDates.forEach(date=>{
                //date.selected.push(room.id);
                console.log(date.selected.push(room.id));
            })
        },
        onChangeWeek(){
            console.log('checkweek');
            this.weekTable.forEach(week=>{
                week.list=[]
            })
            this.plantedDates=[];
            this.selectedDates={};
        },
        checkAvailableRooms(){
            axios.post('/admin/scheduler/available_rooms',{
                'offer':this.offer,
                'dates':this.plantedDates
            }).then(res => {
                this.availableRooms=res.data
                    console.log(res)
            })
            // this.$inertia.post('/admin/scheduler/available_rooms', {
            //     'offer':this.offer,
            //     'dates':this.selectedDates
            // },{
            //         onSuccess:(page)=>{
            //             console.log(page);
            //         },
            //         onError:(err)=>{
            //             console.log(err);
            //         }
            //     });
        },
        getDays(){
            //filter only selected dateOfWeeks, and get only the dow column 
            var selectedWeeks=this.weekTable.filter(day=>day.selected==true).map(d=>parseInt(d.value));
            var startDate = new Date(this.offer.course_start+' 00:00');
            var endDate = new Date(this.offer.course_end+' 23:59');
            this.plantedDates=[];
            //loop every date betwee start to end
            for (var d = startDate; d <= endDate; d.setDate(d.getDate() + 1)) {
                //filter if dow same as selected
                if(selectedWeeks.includes(d.getDay())){
                    //push to plantDates list, the dow is prepare for mapping into display week table
                    this.plantedDates.push({
                        'date':this.formatDate(d),
                        'dow':d.getDay()
                    });
                }
            }
            //loop through weekTable
            this.weekTable.forEach(wTable=>{
                wTable.list=[];
                //loop through plantedDates
                this.plantedDates.forEach(date=>{
                    //if plantedDate of week is same with weekTable
                    if(date.dow==wTable.value){
                        date.start_time=date.date+' '+wTable.start_time;//add start_time column to plantedDates
                        date.end_time=date.date+' '+wTable.end_time;//add end_time column to plantedDates
                        date.room_type=wTable.room_type;//add room_type column to plantedDates
                        wTable.list.push(date);//push to wTable for display
                    }
                })
            })
        },
        //format date to YYYY-MM-DD
        formatDate(date){
            return `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`;
        },
        selectRoom(date, room){
            date.selected.push(room.id);
            console.log(date);
            console.log(room);
        }
    },
}
</script>