$(function () {

    var JSONData = [{name: "hallo", username: "memo"}]
    const base_url = window.location.origin;

    const getUser = async (api) => {
        const response = await fetch(base_url + '/api/' + api + '.php', {
            method: 'POST', body: {
                "x": 5
            }, headers: {
                'Content-Type': 'application/json'
            }
        });
        const JSON = await response.json()
        console.log(response);
        console.log(JSON);

        for (let i = 0; i < JSON.length; i++) {
            if (JSON[i].admin == 1) {
                JSON[i].admin = true
            } else {
                JSON[i].admin = false
            }

            JSONData.push({
                id: JSON[i].id,
                admin: JSON[i].admin,
                name: JSON[i].name,
                username: JSON[i].name,
                email: JSON[i].email,
                passwordHash: JSON[i].passwordHash,
                bio: JSON[i].bio,
            })
        }

        console.log(JSONData)

        Vue.createApp({
            data() {
                return {
                    users: JSONData,
                };
            }
        }).mount("#all-users");
    }
    console.log(getUser('test'))
});
