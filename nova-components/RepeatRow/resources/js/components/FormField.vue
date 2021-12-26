<template>
    <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
        <template slot="field">

            <div  v-for="(item, index) in inputs" :key="index">

                    <label>Price</label>

                    <input type="number"  v-model="item.price "
                           class=" my-6 mx-3  form-input form-input-bordered" style="height: 30px; width: 36%;">


                    <label>Size</label>
                    <select v-model="item.size" class=" form-select my-6" style="height: 30px; width:36%;">
                        <option v-for="(op, index) in options " :value="index">{{ op }}</option>
                    </select>
                   <button class="btn btn-danger p-2 " type="button"  @click="deleteRow(index)" > X</button>
            </div>
            <button @click="addRow" type="button" class="btn btn-primary p-3">Add Row</button>
        </template>
    </default-field>
</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'

export default {

    data() {
        return {
            inputs: [
                {price: '', size: ''}
            ],
            option: [],
            options: '',

            huses: '',

            data: [],
            size: ''
        }
    },
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],
    created() {
        this.huses = this.field.hues;
        this.options = this.field.options
        //
        // let optionElement = "";
        // for (let huse of huses) {
        //
        //     if (huse == 'price') {
        //       this.input=`  <label >Price</label><br> <input  class=" my-6 w-full form-control form-input form-input-bordered"  type="number" />`
        //
        //     } else {
        //         for( const option in options){
        //             console.log(option)
        //             optionElement += ` <option value='${option} '  v-model="price">${options[option]}</option>`
        //
        //         }
        //         this.select= `<label>Size</label><br><select  v-model="size" class="w-full form-control form-select my-6"> ${optionElement}</select>`;
        //
        //     }
        // }

        // this.inputs.push(this.huses)
        this.option.push(this.options)

        // console.log(huses)

    },


    methods: {

        addRow() {
            this.inputs.push({price: '', size: ''})
            // this.inputs.push(this.input)
        },
        deleteRow(index){
           this.inputs.splice(index ,1 )
        },

        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {

            this.value = this.field.value || ''

        },


        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            let self = this;
            formData.append('inputs' , JSON.stringify(self.inputs))
            // formData.append('input', this.inputs || '')
            // formData.append('price', this.price || '')

        },
    },
}
</script>
