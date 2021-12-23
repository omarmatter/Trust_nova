<template>
  <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
    <template slot="field">
        <div v-for="(input, index) in inputs" :key="input.id">
<label></label>
          <div style="m-5"  v-html="input"></div>
        </div>
        <button @click="addRow" type="button" class="btn btn-primary p-3">Add Row</button>
    </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {

    data() {
        return {
            inputs: [] ,
            input:'',
            select:'',
                price: '',
                size: ''
        }
    },
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],
    created() {
        const huses = this.field.hues;
        const options = this.field.options

        let optionElement = "";
        for (let huse of huses) {

            if (huse == 'price') {
              this.input=`  <label >Price</label><br> <input  class=" my-6 w-full form-control form-input form-input-bordered"  type="number" />`

            } else {
                for( const option in options){
                    console.log(option)
                    optionElement += ` <option value='${option} '  v-model="price">${options[option]}</option>`

                }
                this.select= `<label>Size</label><br><select  v-model="size" class="w-full form-control form-select my-6"> ${optionElement}</select>`;

            }
        }

        this.inputs.push(this.select)
        this.inputs.push(this.input)

    },




  methods: {

          addRow () {
              this.inputs.push(this.select)
              this.inputs.push(this.input)
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
  console.log(this.price)
      formData.append(this.field.attribute, this.value || '')
    },
  },
}
</script>
