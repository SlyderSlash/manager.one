<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>testmanager</title>
    <link href="style.css" rel="stylesheet" type="text/css" />

  </head>
  <body>
    <div id="container">
      <div id="header">
        <h1>testmanager</h1>
      </div>
      <nav>
        <button id='userBtn'>Utilisateur</button>
        <button id='tasksBtn'>Toute les tâches</button>
      </nav>
      <form>
          <p>
            <label for="idUser">Identifiant de l'utilisateur :</label>
            <input type="number" name="idUser" id="idUser" required/>
          </p>
          <input type="submit" value="Recherche" id="subIdUser"/>
      </form>
      <div id="userPart">
        <h2>Ajouter un utilisateur</h2>
        <form>
          <p>
            <label for="name">Nom de l'utilisateur :</label>
            <input type="text" name="name" id="name" required/>
          </p>
          <p>
            <label for="email">Email de l'utilisateur :</label>
            <input type="email" name="email" id="email" required/>
          </p>
          <input type="submit" value="Ajouter" id="subUser"/>
        </form>
        
        <div id='userInfo'>
          <h2>Utilisateur</h2>
          <div>
            <h2> LISTE </h2>
            <ul id="userList"></ul>
          </div>
        </div>
      </div>
      <div id="tasksPart" style="display:none;">
        <form>
            <p>
              <label for="title">Nom de la tâche :</label>
              <input type="text" name="title" id="title" required/>
            </p>
            <p>
              <label for="description">Description de la tâche :</label>
              <input type="text" name="description" id="description" required/>
            </p>
            <p>
              <label for="user_id">Identifiant de l'utilisateur :</label>
              <input type="number" name="user_id" id="user_id" required/>
            </p>
            <p>
              <label for="status">Status de la tâche :</label>
              <input type="text" name="status" id="status" required/>
            </p>
            <input type="submit" value="Ajouter" id="subTask"/>
        </form>
        <div>
          <ul id="taskList">
          </ul>
        </div>
      </div>
    </div>
  </body>
  <script type="text/javascript" src="script.js"></script>
</html>
