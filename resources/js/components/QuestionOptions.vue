<template>
    <div class="card-body">
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-success" @click="addOption">
                    Add Question Option
                </button>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>
                    Option Text
                </th>
                <th>
                    Is Correct
                </th>
                <th>
                    &nbsp;
                </th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(option, index) in options" :key="index">
                    <td>
                        <input class="form-control" type="text" :name="'option_text[' + index + ']'" v-model="option.option_text" required>
                    </td>
                    <td>
                        <input type="checkbox" :name="'is_correct[' + index + ']'" value="1" v-model="option.is_correct">
                    </td>
                    <td>
                        <button type="button" class="btn btn-xs btn-danger" @click="deleteOption(index)">
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            oldOptionText: Array,
            oldIsCorrect: [Array, Object]
        },

        created() {
            if (this.oldOptionText.length) {
                this.oldOptionText.forEach((value, index) => {
                    this.options.push({
                        option_text: value,
                        is_correct: this.oldIsCorrect[index] ? true : false
                    });
                });
            }
        },

        data: function () {
            return {
                options: []
            };
        },

        methods: {
            addOption: function () {
                let lastOption = this.options.slice(-1).pop();
                if (!lastOption || lastOption.option_text != '') {
                    this.options.push({
                        option_text: '',
                        is_correct: false
                    });
                }
            },
            deleteOption: function (index) {
                if (typeof this.options[index] !== 'undefined') {
                    this.options.splice(index, 1);
                }
            }
        }
    }
</script>
