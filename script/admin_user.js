$(function () {

        var JSONData = []
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
                    JSON[i].admin = "fa-solid fa-check IsAdmin"
                } else {
                    JSON[i].admin = "fa-solid fa-xmark IsNotAdmin"
                }

                JSONData.push({
                    id: JSON[i].id,
                    admin: JSON[i].admin,
                    name: JSON[i].name,
                    username: JSON[i].name,
                    email: JSON[i].email,
                    passwordHash: JSON[i].passwordHash,
                    bio: JSON[i].bio,
                    search: "",
                })
            }

            console.log(JSONData)

            Vue.createApp({
                data() {
                    return {
                        users: JSONData,
                        search: "",
                    };
                },
                computed: {
                    filteredUsers() {
                        return this.users.filter(p => {
                            return p.username.toLowerCase().indexOf(this.search.toLowerCase()) != -1;
                        });
                    }
                }
            }).mount("#all-users");
        }
        getUser('admin_reg_user')
    }
);
// Make the DIV element draggable:
// dragElement(document.getElementById("mydiv"));
//
// function dragElement(elmnt) {
//     var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
//     if (document.getElementById(elmnt.id + "header")) {
//         // if present, the header is where you move the DIV from:
//         document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
//     } else {
//         // otherwise, move the DIV from anywhere inside the DIV:
//         elmnt.onmousedown = dragMouseDown;
//     }
//
//     function dragMouseDown(e) {
//         e = e || window.event;
//         e.preventDefault();
//         // get the mouse cursor position at startup:
//         pos3 = e.clientX;
//         pos4 = e.clientY;
//         document.onmouseup = closeDragElement;
//         // call a function whenever the cursor moves:
//         document.onmousemove = elementDrag;
//     }
//
//     function elementDrag(e) {
//         e = e || window.event;
//         e.preventDefault();
//         // calculate the new cursor position:
//         pos1 = pos3 - e.clientX;
//         pos2 = pos4 - e.clientY;
//         pos3 = e.clientX;
//         pos4 = e.clientY;
//         // set the element's new position:
//         elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
//         elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
//     }
//
//     function closeDragElement() {
//         // stop moving when mouse button is released:
//         document.onmouseup = null;
//         document.onmousemove = null;
//     }
// }