<template>
  <div id="Bell">
  
   
    <notification-bell
      class="bell"
      :size="size"
      :count="count"
      :ding="ding"
      :upperLimit="upperLimit"
      :counter-location="counterLocation"
      :counterStyle="counterStyle"
      :counterBackgroundColor="counterBackgroundColor"
      :counterTextColor="counterTextColor"
      :iconColor="iconColor"
      :animated="animated"
      :top="top"
      :left="left"
      :prefixPlus="prefixPlus"
      :fontSize="fontSize"
      :counterPadding="counterPadding"
    />
   
   
  </div>
</template>

<script>
import NotificationBell from './NotificationBell.vue'
import SourceCode from './SourceCode.vue'

export default {
  name: 'Bell',
  data () {
    return {
      size: 28,
      customLocation: false,
      counterLocation: 'upperRight',
      top: null,
      left: null,
      count: 2,
      ding: false,
      upperLimit: 50,
      counterStyle: 'round',
      counterBackgroundColor: '#FF0000',
      counterTextColor: '#FFFFFF',
     iconColor:"#047108",
      animated: false,
      prefixPlus: false,
      customFontSize: false,
      fontSize: '20px',
      customCounterPadding: false,
      //counterPadding: null,
      counterPadding:"1px",
       notifications:[],
    }
  },
    mounted(){
        this.determineConnectionStatus()
    },
   created() {
        setInterval(this.determineConnectionStatus, 1000);
    },

   methods: {
      determineConnectionStatus() {
            // const lastHeartBeatReceivedSecondsAgo = moment().diff(
            //     this.lastHeartBeatReceivedAt,
            //     'seconds'   );
            //      await this.axios.get('/bell').then(response=>{
            //     //this.grouplist = response.data
            // }).catch(error=>{
            //     console.log(error)
            //     //this.categories = []
                        // })
             
         
   },
 },

  watch: {
    'customLocation' (newValue) {
      if (!newValue) {
        this.top = this.left = null
      }
    },
    'customFontSize' (newValue) {
      if (!newValue) {
        this.fontSize = null
      }
    },
    'customCounterPadding' (newValue) {
      if (!newValue) {
        this.counterPadding = null
      }
    }
  },
  components: {
    SourceCode,
    NotificationBell
  }
}
</script>
<style lang="sass">
*, button, input
  margin: 0
  padding: 0
  font-family: sans-serif
  #app
      display: inline
      grid-template-columns: 1fr 2fr 1fr
      grid-template-rows: auto 1fr auto
      header, footer
        grid-column: 1 / -1
        text-align: center
        padding: 10px 0
      header
        border-bottom: 1px solid black
      footer
        border-top: 1px solid black
      .controls
        padding: 20px
        border-right: 1px solid black
        display: grid
        grid-row-gap: 20px
        .input-container
          display: grid
          grid-template-columns: auto 1fr
          grid-column-gap: 10px
          align-items: center
          label
            font-size: 14px
        .docs
          text-align: center
          align-self: end
          a
            color: black
            font-size: 20px
      .bell
        padding: 15px
        justify-self: center
        align-self: center
</style>
