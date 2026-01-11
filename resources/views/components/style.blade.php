<style>
    #table1 {
        table-layout: fixed;
        /* Paksa patuhi lebar kolom */
        width: 100%;
    }

    #table1 th:nth-child(1) {
        width: 5%;
    }

    #table1 th:nth-child(2) {
        width: 60%;
    }

    #table1 th:nth-child(3) {
        width: 30%;
    }

    /* Optional: biar teks panjang terpotong dan ada ... */
    #table1 td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .camera-icon {
        bottom: 8px;
        right: 8px;
        background-color: #3f51b5;
        /* biru ala Material UI */
        color: white;
        border-radius: 50%;
        padding: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        position: absolute;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        transition: background 0.2s;
    }

    .camera-icon:hover {
        background-color: #303f9f;
        /* lebih gelap saat hover */
    }
</style>
