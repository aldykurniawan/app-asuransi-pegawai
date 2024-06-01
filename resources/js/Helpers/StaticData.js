import axios from 'axios';

const getStaticData = async () => {
    // const localData = localStorage.getItem("staticData");
    // if (localData) {
    //     return true;
    // }
    const response = await axios.get("/statik-data");
    // set to localstorage
    localStorage.setItem("staticData", JSON.stringify(response.data));
    return true;
};

export default getStaticData;
