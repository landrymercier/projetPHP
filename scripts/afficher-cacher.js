/*SOURCE = http://www.supportduweb.com/scripts_tutoriaux-code-source-33-afficher-cacher-un-div-element-en-javascript.html*/
function afficher_cacher(id)
{
    if(document.getElementById(id).style.display=="none")
    {
        document.getElementById(id).style.display="block";
        document.getElementById('bouton_'+id).innerHTML='Cacher les informations de la plage';
    }
    else
    {
        document.getElementById(id).style.display="none";
        document.getElementById('bouton_'+id).innerHTML='Afficher les informations de la plage';
    }
    return true;
}