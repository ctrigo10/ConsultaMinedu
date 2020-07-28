<template>
    <v-container>
        <v-row>
            <v-col lg="5" sm="12"> 
                <v-form
                ref="form"
                @submit.prevent="search()"
                >
                    <v-row>
                        <v-col lg="7">
                            <v-text-field
                            v-model="student.ci"
                            label="NÚMERO DE IDENTIDAD"
                            required
                            maxlength="10"
                             onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                            ></v-text-field>
                        </v-col>
                        <v-col lg="5">
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

                    <v-row>
                      
                    <vue-recaptcha 
                    ref="recaptcha"
                    @verify="onVerify"
                    sitekey="6Le0dbYZAAAAAA-9DYVUvoMWdHqbB_qqWCEmiDwe"
                    >
                    </vue-recaptcha>
                                    
                    </v-row>
                                     
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
                    max-width="100%"
                >
                    <v-card-title>
                    <v-icon
                        large
                        left
                    >
                        mdi-message-text-outline
                    </v-icon>
                    <span class="title font-weight-black">BECAS SOCIALES 2020</span>
                    </v-card-title>

                    <v-card-text class="h5 text-justify font-weight-medium">
                         {{ state }}
                         <br><br> 
                         <template v-if="mensaje2">
                            {{ mensaje2 }}
                            <br><br>
                        </template>  
                         "Por un Pacto Nacional para la Transformación Educativa"
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
      mensaje_inicial: "Ingrese su número de C.I. (el Complemento si corresponde) y fecha de nacimiento.",
      state: "Ingrese su número de C.I. (el Complemento si corresponde) y fecha de nacimiento.",
      recaptcha: '',
      mensaje2: '',
    }),
    watch: {
      menu (val) {
        val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
      },
    },
    methods: {
        onVerify(response) {
               this.recaptcha = response
            },
      save (date) {
        this.$refs.menu.save(date)
      },
      cancel(){
        this.student.ci=null;
        this.student.complement=null,
        this.student.date=null
        this.state = this.mensaje_inicial
        this.recaptcha = ""
        this.mensaje2 = ""
        this.$refs.recaptcha.reset();
      },
      async search(){
          if(this.student.ci == null || this.student.ci == ""){
              this.state = "El número de Cédula de Identidad es un dato requerido."
              this.recaptcha = ""
          } else if(this.student.date == null || this.student.date == ""){
              this.state = "La fecha de nacimiento es un dato requerido."
              this.recaptcha = ""
          }else if(this.$refs.recaptcha)
                    if(this.recaptcha == "")
                        this.state = "Haga click en NO SOY UN ROBOT."
          else{
              try {
                  let res = await axios.post(`http://localhost:8000/api/student/search`,this.student)
                  if(res.data.scholarship){
                      this.state = `${res.data.full_name}: El Ministerio de Educación a través del Viceministerio de 
                      Educación Superior de Formación Profesional comunica que usted ha sido beneficiado a una Beca Social 2020.`
                      this.mensaje2 = `Para mayor información respecto a la entrega de la misma, por favor comunicarse con la Dirección General 
                      de Educación Superior Universitaria o la Dirección General de Educación Superior Técnica Tecnológica Lingüística y Artística.`
                  }
                  else {
                      this.state = `El Ministerio de Educación a través del Viceministerio de Educación Superior de Formación 
                      Profesional comunica que usted no ha sido beneficiado a una Beca Social 2020.`
                      this.mensaje2 = `Para mayor información por favor comunicarse con la Dirección General de Educación Superior Universitaria o 
                      la Dirección General de Educación Superior Técnica Tecnológica Lingüística y Artística.`
                  }
                  this.$refs.recaptcha.reset();
                  this.recaptcha = ""
                  console.log(res);
              }catch(e){
                  console.log(e);
              }
          }
          
      }
    },
  }
</script>