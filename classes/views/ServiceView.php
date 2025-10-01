<?php

class ServiceView
{

    public function render($animal, $treatments, $services, $flash = null)
    {
        // htmlspecialchars to prevent xss injection
        $animalId = htmlspecialchars($animal['id']);
        $animalName = htmlspecialchars($animal['name']);
        $today = date('Y-m-d\TH:i'); // (YYYY-MM-DD HH:MM)

        // If flash is set, set flashMessage and flashClass
        if ($flash) {
            $flashMessage = htmlspecialchars($flash['message']);
            $flashClass = htmlspecialchars($flash['class']);
        }
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Veterinary Records - Service</title>
            <link rel="stylesheet" href="css/style.css" />
            <link rel="stylesheet" href="css/serviceStyle.css" />
        </head>

        <body>
            <section id="title-area">
                <h1>Service</h1>
                <a href="index.php?searchValue=" class="button">Back</a>
            </section>

            <?php if ($flash): ?>
                <div class="<?= $flashClass ?>"><?= $flashMessage ?></div>
            <?php endif; ?>

            <section id="treatment-area">
                <h1>Service Record</h1>
                <form method="post" id="service-form">
                    <input type="hidden" name="animal_id" value="<?= $animalId ?>" />
                    <div class="form-item">
                        <label>Animal Name:</label>
                        <input type="text" disabled value="<?= $animalName ?>" />
                    </div>

                    <div class="form-item">
                        <label>Date:</label>
                        <input type="datetime-local" name="service_date" value="<?= $today ?>" required />
                    </div>

                    <div class="form-item">
                        <label>Treatment:</label>
                        <select name="treatment_id" id="treatment-select" required>
                            <option value="" selected disabled>Select Treatment</option>

                            <?php foreach ($treatments as $treatment): ?>
                                <option
                                    value="<?= htmlspecialchars($treatment->id) ?>"
                                    data-desc="<?= htmlspecialchars($treatment->description) ?>">
                                    <?= htmlspecialchars($treatment->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-block-item">
                        <label>Treatment Description:</label>
                        <textarea id="treatment-desc" rows="2" disabled></textarea>
                    </div>

                    <div class="form-block-item">
                        <label>Service Description / Observations:</label>
                        <textarea name="observation" rows="6" placeholder="Describe service or observation..." required></textarea>
                    </div>

                    <button class="button" type="submit" name="save">Save</button>
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
                                <th>Observation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($services) === 0): ?>
                                <tr>
                                    <td colspan="3">No records yet.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($services as $service): ?>
                                    <?php
                                    // $service->date expected to be a datetime string
                                    $date = htmlspecialchars($service->date);
                                    // format friendly: dd/mm/YYYY at hh:mm if possible
                                    $displayDate = $date;
                                    $dt = DateTime::createFromFormat('Y-m-d H:i:s', $service->date);

                                    if ($dt) {
                                        $displayDate = $dt->format('d/m/Y \a\t H:i');
                                    } else {
                                        // try ISO format
                                        $dt2 = DateTime::createFromFormat(DateTime::ATOM, $service->date);
                                        if ($dt2) {
                                            $displayDate = $dt2->format('d/m/Y \a\t H:i');
                                        }
                                    }

                                    $treatmentName = htmlspecialchars($service->treatment->name ?? '—');
                                    $observation = htmlspecialchars($service->observation);
                                    ?>
                                    <tr>
                                        <td class="date"><?= $displayDate ?></td>
                                        <td><?= $treatmentName ?></td>
                                        <td><?= $observation ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <script>
                // Fill treatment description when user selects a treatment
                (function() {
                    const sel = document.getElementById('treatment-select');
                    const desc = document.getElementById('treatment-desc');

                    sel && sel.addEventListener('change', function() {
                        const opt = sel.selectedOptions[0];
                        desc.value = opt ? opt.dataset.desc || '' : '';
                    });
                })();
            </script>
        </body>

        </html>
<?php
    }
}
