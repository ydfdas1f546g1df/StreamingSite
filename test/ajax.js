$(function () {
    const base_url = window.location.origin;

    const getUser = async (api) => {
        const response = await fetch(base_url + '/api/'+api+'.php', {
            method: 'POST',
            body: {
                "x": 5
            },
            headers: {
                'Content-Type': 'application/json'
            }
        });
        const JSON  = await response.json()
        console.log(response);
        console.log(JSON)
    }
    console.log(getUser('test'))
});
