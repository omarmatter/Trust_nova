<template>
    <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
        <template slot="field">

            <div style="display: flex" v-for="(item, index) in inputs" :key="index">
<div class="col">
                <label>Price </label>

                <input type="number"  v-model="item.price "
                       class=" my-3 mx-3  form-input form-input-bordered  " style="height: 30px; width: 50%;">


        <div v-if="errors.errors.price"  class="error-text  text-danger help-text" >{{errors.errors.price[index] }} </div>

</div>
                <div class="col-md-2">

                <label>Size</label>
                <select v-model="item.size" class=" form-select my-3" @change="setOptionsSelected()" style="height: 30px; width:50%;" >

                    <option v-for="(op, index) in options " v-show="!options_selected.includes(index)" :value="index" >{{ op }}</option>
                </select>
                    <button class="btn btn-danger p-2 " type="button" v-if="inputs.length >1"    @click="deleteRow(index)" > X</button>
                    <br>

                    <span v-if="errors.errors.size"  class="error-text  text-danger help-text">{{errors.errors.size[index] }} </span>

                </div>
            </div>
            <button @click="addRow" type="button" class="btn btn-primary p-3">Add Row</button>
        </template>
    </default-field>
</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'
import Vue from 'vue'

export default {

    data() {
        return {
            inputs: [
                {price: '', size: ''}
            ],


            options: [],
            huses: '',
            data: [],
            selected:[],
            size: '',

            options_selected : []
        }
    },
    mixins: [FormField, HandlesValidationErrors],
    props: ['resourceName', 'resourceId', 'field' ],
    created() {
        this.huses = this.field.hues;
        this.options = this.field.options

    },
    methods: {
        addRow() {
            this.inputs.push({price: '', size: ''})
        },
        deleteRow(index){
            this.inputs.splice(index ,1 );
            this.setOptionsSelected();
        },

        setInitialValue() {
            this.value = this.field.value || ''
        },

        fill(formData) {
            let self = this;
            formData.append('inputs' , JSON.stringify(self.inputs))

        },
        setOptionsSelected : function () {
          this.options_selected = [];
          for (var i = 0; i < this.inputs.length ; i++) {
             if(this.inputs[i].size) {
                 this.options_selected.push(this.inputs[i].size)
             }
          }
          console.log(this.options_selected);
        },




    },



}
</script>
