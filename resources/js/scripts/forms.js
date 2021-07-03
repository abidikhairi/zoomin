const $ = require('jquery')
const axios = require('axios')

if (document.getElementById('claim-form') || document.getElementById('report-form')) {
    $('#establishment-field').hide()

    $('#sector').change(function (event) {
        $('#establishment').find('option').remove().end()
        const sector_id = $(this).children("option:selected").val()
        axios.get('http://localhost:8000/api/establishment/'+sector_id)
            .then(response => {
                const establishments = response.data
                $('#establishment-field').show()
                establishments.map(elem => {
                    $('#establishment').append(new Option(elem.name, elem.id))
                })
            }).catch(err => {
                alert(err)
            })
        console.log(sector_id)
        console.log('hello World')
    })
}

// TODO: Ajaxify This
if (document.getElementsByClassName('assign-claim')) {
    $('.assign-claim').click(function (event) {
        const claim_id = $(event.target).data('claim')
        console.log(claim_id)
        $('#claim-field').val(claim_id)
    })
}

if (document.getElementById('observations-forms')) {
    $('#send-observations').click(function (event){
        $('form').filter(function (){
            return this.id.match(/observation-[0-9]+/)
        }).each(function (i, form) {
            let url = form.action
            let method = form.method
            let data = new FormData(form)
            axios({
                method: method,
                url: url,
                data: data,
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            }).then(response => {
                const {message} = response.data
                alert(message)
                form.reset()
            }).catch(err => {
                alert(err)
            })
        })
    });
}
