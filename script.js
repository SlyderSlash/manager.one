// User Part
let subUser = document.getElementById('subUser')
let mail = document.getElementById('email')
let uname = document.getElementById('name')
let userID = document.getElementById('idUser')
let subIDUser = document.getElementById('subIdUser')
let userInfo = document.getElementById('userInfo')
let userList = document.getElementById('userList')
const getUsers = () => {
    let httpPost = new XMLHttpRequest()
        httpPost.open('GET', 'https://projectmanagerone.herokuapp.com/users/', true)
        httpPost.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpPost.onreadystatechange = () => {
            if (httpPost.readyState == 4 && httpPost.status == 200) {
                let response = httpPost.responseText
                let users = JSON.parse(response)
                users.users.forEach((user) => {
                    userList.innerHTML += `<li>
                    <h2>${user.name}</h2>
                    <p>${user.email}</p>
                    <button id='${user.id}-DelUserButton' class='deleteUser'>Supprimer</button>
                    </li>`
                })
                let userDBtn = document.querySelectorAll('.deleteUser')  
                userDBtn.forEach((t) => {
                    t.addEventListener('click',(evt) => {
                        userList.innerHTML = ''
                        deleteUser(evt.target.id.split('-')[0],getUsers())
                    })
                })
            }
            if (httpPost.readyState == 4 && httpPost.status == 404) {
                alert("Utilisateur introuvable")
            }
         }
         httpPost.send()
}
const deleteUser = (id,next) => {
    let httpPost = new XMLHttpRequest()
        httpPost.open('DELETE', 'https://projectmanagerone.herokuapp.com/user/' + id, true)
        httpPost.onreadystatechange = () => {
            if (httpPost.readyState == 4 && httpPost.status == 200) {
                console.log(`Response = ${httpPost.responseText}`)
                alert(`User deleted successfully`)
                userList.innerHTML = ''
                next()
            }
            else if (httpPost.readyState == 4 && httpPost.status != 200) {
                alert("Une erreur est survenue")
            }
         }
        httpPost.send()
}
const sendBlockerUser= (evt) => {
    evt.preventDefault();
    if(uname.value=='' || mail.value==''){
        alert('Le nom et le mail sont obligatoires')
        return
    }
    else {
        let httpPost = new XMLHttpRequest()
        httpPost.open('POST', 'https://projectmanagerone.herokuapp.com/users', true)
        httpPost.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpPost.onreadystatechange = () => {
            if (httpPost.readyState == 4 && httpPost.status == 201) {
                uname.value = ''
                mail.value = ''
                alert("Utilisateur ajouté avec succés")
            }
         }
         httpPost.send(`name=${uname.value}&email=${mail.value}`)
    }
}
const deleteTask = (id,next) => {
    let httpPost = new XMLHttpRequest()
        httpPost.open('DELETE', 'https://projectmanagerone.herokuapp.com/task/' + id, true)
        httpPost.onreadystatechange = () => {
            if (httpPost.readyState == 4 && httpPost.status == 200) {
                alert(`Task deleted successfully`)
                taskList.innerHTML = ''
                next()
            }
            else if (httpPost.readyState == 4 && httpPost.status != 200) {
                alert("Une erreur est survenue")
            }
         }
        httpPost.send()
}
const sendBlockerIDUser= (evt,id) => {
    if(evt == null){
        userID = {value : id}
        
    }
    else {
        evt.preventDefault();
    }
    if(userID.value==''){
        alert('L\'ID utilisateur est obligatoire')
        return
    }
    else {
        let httpPost = new XMLHttpRequest()
        httpPost.open('GET', 'https://projectmanagerone.herokuapp.com/user/' + userID.value, true)
        httpPost.onreadystatechange = () => {
            if (httpPost.readyState == 4 && httpPost.status == 200) {
                let response = httpPost.responseText
                let user = JSON.parse(response)
                userInfo.innerHTML = `<h2>${user.name}</h2>
                <p>${user.email}</p>`
            }
            if (httpPost.readyState == 4 && httpPost.status == 404) {
                alert("Utilisateur introuvable")
            }
         }
        httpPost.send()
        let httpPostTask = new XMLHttpRequest()
        httpPostTask.open('GET', 'https://projectmanagerone.herokuapp.com/usertasks/' + userID.value, true)
        httpPostTask.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpPostTask.onreadystatechange = () => {
            if (httpPostTask.readyState == 4 && httpPostTask.status == 200) {
                let response = httpPostTask.responseText
                let tasks = JSON.parse(response)
                console.log(tasks)
                tasks.tasks.forEach((task) => {
                taskList.innerHTML += `<li>
                    <h2>${task.title}</h2>
                    <p>${task.description}</p>
                    <h3>${task.status}</h3>
                    <button id='${task.id}-DelTaskButton-${task.user_id}' class='deleteTask'>Supprimer</button>
                    </li>`
                })
                let taskBtn = document.querySelectorAll('.deleteTask')  
                console.log(taskBtn)
                taskBtn.forEach((t) => {
                    t.addEventListener('click',(evt) => {
                        deleteTask(evt.target.id.split('-')[0],sendBlockerIDUser(null,evt.target.id.split('-')[2]))
                    })
                })
                tasksPart.style.display = ''
                userBtn.style.display = ''
                tasksBtn.style.display = ''
                userPart.style.display = 'none'
            }
            if (httpPostTask.readyState == 4 && httpPostTask.status == 404) {
                alert("Tâches introuvable")
            }
         }
         httpPostTask.send()
    }
}

subUser.addEventListener('click', sendBlockerUser, false)
subIDUser.addEventListener('click', sendBlockerIDUser, false)

// Task Part
let subTask = document.getElementById('subTask')
let title = document.getElementById('title')
let description = document.getElementById('description')
let user_id = document.getElementById('user_id')
let status = document.getElementById('status')
let taskList = document.getElementById('taskList')

const sendBlockerTask = (evt) => {
    evt.preventDefault();
    if(title.value=='' || description.value=='' || user_id.value=='' || status.value == ''){
        alert('Les champs sont obligatoires')
        return
    }
    else {
        let httpPost = new XMLHttpRequest()
        httpPost.open('POST', 'https://projectmanagerone.herokuapp.com/tasks/', true)
        httpPost.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpPost.onreadystatechange = () => {
            if (httpPost.readyState == 4 && httpPost.status == 201) {
                uname.value = ''
                mail.value = ''
                alert(`Tâche ${title.value} : ajoutée avec succés`)
            }
            else if (httpPost.readyState == 4 && httpPost.status == 400) {
                alert("Une erreur est survenue")
            }
         }
         httpPost.send(`title=${title.value}&description=${description.value}&user_id=${user_id.value}&status=${status.value}`)
    }
}
subTask.addEventListener('click', sendBlockerTask, false)


// buttonPart
const getTasks = () => {
    let httpPost = new XMLHttpRequest()
        httpPost.open('GET', 'https://projectmanagerone.herokuapp.com/tasks/', true)
        httpPost.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpPost.onreadystatechange = () => {
            if (httpPost.readyState == 4 && httpPost.status == 200) {
                let response = httpPost.responseText
                let tasks = JSON.parse(response)
                tasks.tasks.forEach((task) => {
                    taskList.innerHTML += `<li>
                    <h2>${task.title}</h2>
                    <p>${task.description}</p>
                    <h3>${task.status}</h3>
                    <button id='${task.id}-DelTaskButton-${task.user_id}' class='deleteTask'>Supprimer</button>
                    </li>`
                })
                let taskBtn = document.querySelectorAll('.deleteTask')  
                console.log(taskBtn)
                taskBtn.forEach((t) => {
                    t.addEventListener('click',(evt) => {
                        taskList.innerHTML = ''
                        deleteTask(evt.target.id.split('-')[0],getTasks())
                    })
                })
            }
            if (httpPost.readyState == 4 && httpPost.status == 404) {
                alert("Tâches introuvable")
            }
         }
         httpPost.send()
}
const userBtn = document.getElementById('userBtn')
const tasksBtn = document.getElementById('tasksBtn')
const userPart = document.getElementById('userPart')
const tasksPart = document.getElementById('tasksPart')

if (userPart.style.display == ''){
    getUsers()
    userBtn.style.display = 'none'
    tasksBtn.style.display = ''
}
tasksBtn.addEventListener('click',() => {
    getTasks()
    userBtn.style.display = ''
    tasksBtn.style.display = 'none'
    userPart.style.display = 'none'
    tasksPart.style.display = ''
})
userBtn.addEventListener('click',() => {
    userBtn.style.display = 'none'
    tasksBtn.style.display = ''
    userPart.style.display = ''
    tasksPart.style.display = 'none'
})

