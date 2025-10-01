<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Veterinary Records</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/serviceStyle.css" />
</head>

<body>
    <section id="title-area">
        <h1>Service</h1>
        <a href="index.php?searchValue=" class="button">Back</a>
    </section>

    <section id="treatment-area">
        <h1>Service Record</h1>
        <form>
            <div class="form-item">
                <label>Animal Name:</label>
                <input type="text" disabled />
            </div>

            <div class="form-item">
                <label>Date:</label>
                <input type="date" value="2024-08-04" />
            </div>

            <div class="form-item">
                <label>Treatment:</label>
                <select>
                    <option selected disabled>Select Treatment</option>
                </select>
            </div>

            <div class="form-block-item">
                <label>Treatment Description:</label>
                <textarea rows="2" disabled>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facere ducimus saepe eum ea id, ex, deleniti non repellendus impedit provident laborum perferendis excepturi voluptate voluptatum magnam dolor rerum, laudantium velit?</textarea>
            </div>

            <div class="form-block-item">
                <label>Service Description:</label>
                <textarea rows="6"></textarea>
            </div>

            <button class="button">Save</button>
        </form>
    </section>

    <section id="history-area">
        <h1>History</h1>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Treatment</th>
                        <th>Treatment Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="date">08/30/2024 at 11:35</td>
                        <td>Deworming</td>
                        <td>There was an allergic reaction and Apoquel 6g was administered</td>
                    </tr>
                    <tr>
                        <td class="date">08/30/2024 at 11:30</td>
                        <td>Rabies Vaccine</td>
                        <td>Renew in 1 year</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

</body>

</html>