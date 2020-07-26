<template>
    <v-container>
        <v-row>
            <v-col lg="7" sm="12"> 
                <v-form
                ref="form"
                @submit.prevent="search()"
                >
                    <v-row>
                        <v-col lg="8">
                            <v-text-field
                            v-model="student.ci"
                            label="NÚMERO DE IDENTIDAD"
                            required
                            maxlength="10"
                             onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                            ></v-text-field>
                        </v-col>
                        <v-col lg="4">
                            <v-text-field
                                v-model="student.complement"
                                label="Complemento"
                                maxlength="2"
                                style="text-transform:uppercase;" 
                                onkeyup="javascript:this.value=this.value.toUpperCase();"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-menu
                            ref="menu"
                            v-model="menu"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            offset-y
                            min-width="290px"
                        >
                            <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="student.date"
                                label="FECHA DE NACIMIENTO"
                                prepend-icon="event"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                            </template>
                            <v-date-picker
                            ref="picker"
                            v-model="student.date"
                            :max="new Date().toISOString().substr(0, 10)"
                            min="1950-01-01"
                            @change="save"
                            ></v-date-picker>
                        </v-menu>
                    </v-row>
                                                        <div class="form-group">
                                        <vue-recaptcha 
                                        ref="recaptcha"
                                        @verify="onVerify"
                                        sitekey="6Le0dbYZAAAAAA-9DYVUvoMWdHqbB_qqWCEmiDwe">
                                    
                                        </vue-recaptcha>
                                    </div>
                                     
                    <v-row col="12" align="center">
                            <v-btn class="ma-2" 
                                color="purple"
                                @click="cancel()"
                                outlined
                                >
                                CANCELAR
                            </v-btn>
                            
                            <v-btn class="ma-2 white--text" 
                                color="purple"
                                type="submit"   
                                >
                                CONSULTAR
                            </v-btn>
                  
                    </v-row>
                </v-form>
            </v-col>
            <v-col>
                 <v-card
                    class="mx-auto"
                    color="#644491"
                    dark
                    max-width="400"
                >
                    <v-card-title>
                    <v-icon
                        large
                        left
                    >
                        mdi-message-text-outline
                    </v-icon>
                    <span class="title font-weight-light">Mensaje</span>
                    </v-card-title>

                    <v-card-text class="headline font-weight-bold">
                         {{ state }}
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import VueRecaptcha from 'vue-recaptcha';
  export default {
    components: { VueRecaptcha },

    data: () => ({
      menu: false,
      student:{ci : null, complement : null, date: null},
      mensaje_inicial: "Ingrese el número de CI, el complemento si se requiere y su fecha de nacimiento",
      state: "Ingrese el número de CI, el complemento si se requiere y su fecha de nacimiento",
      recaptcha: '',
    }),
    watch: {
      menu (val) {
        val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
      },
    },
    methods: {
        onVerify(response) {
               this.recaptcha = response;
               console.log(this.recaptcha)
            },
      save (date) {
        this.$refs.menu.save(date)
      },
      cancel(){
        this.student.ci=null;
        this.student.complement=null,
        this.student.date=null
        this.state = this.mensaje_inicial
      },
      async search(){
          if(this.student.ci == null){
              this.state = "El número de identidad es dato requerido"
          } else if(this.student.date == null){
              this.state = "La fecha de nacimiento es dato requerido"
          }
          else{
              try {
                  let res = await axios.post(`http://localhost:8000/api/student/search`,this.student)
                  if(res.data.state == 'approved') this.state = "El propietario de la Cédula de identidad proporcionada esta APROBADO"
                  else if(res.data.state == 'denied') this.state = "El propietario de la Cédula de identidad proporcionada esta DENEGADO"
                  else this.state = "El propietario de la Cédula de identidad proporcionada NO EXISTE en la lista"
                  this.$refs.recaptcha.reset();
                  console.log(res);
              }catch(e){
                  console.log(e);
              }
          }
          
      }
    },
  }
</script>