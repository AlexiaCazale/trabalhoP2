async function searchMemberData(ele) {
    let user_email = ele.value;

    try {
        const response = await fetch(`http://localhost/trabalhoP2/buscar_usuario?email=${user_email}`);
        if (!response.ok) {
            throw new Error(`Status da resposta: ${response.status}`);
        }

        const json = await response.json();
        console.log(json);
    } catch (error) {
        console.error(error.message);
    }
}