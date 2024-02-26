<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var array<\App\Models\Category> $categories
 * @var array<\App\Kernel\Auth\User> $users
 * @var array $months
 * @var array $userCount
 */


?>
<?php $view->components('start'); ?>


    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <table class="table table-dark table-hover mt-5">
                    <thead>
                    <tr>
                        <th scope="col">Avatar</th>
                        <th scope="col">Username</th>
                        <th scope="col">Mail</th>
                        <th scope="col">роль</th>
                        <th scope="col">действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <td style="width: 200px;">
                                <img width="100px" src="<?php echo $storage->url($user->getAvatar()) ?>" alt="">
                            </td>
                            <td style="width: 200px;"><?php echo $user->getName() ?></td>
                            <td><span class="badge"><?php echo $user->getEmail() ?></span></td>
                            <td><span class="  <?php echo $user->getUserRole()?>  "><?php echo $user->getUserRole()?></span></td>
                            <td>
                                <div class="dropdown d-flex justify-content-end">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Действие
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a class="dropdown-item" href="/admin/user/update?id=<?php echo $user->getId()?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                </svg>
                                                <span>Изменить</span>
                                            </a>
                                        </li>
                                        <li>
                                            <form action="/admin/movies/destroy" method="post">
                                                <input type="hidden" name="id" value="">
                                                <button class="dropdown-item" href="#">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                    </svg>
                                                    <span>Удалить</span>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <h2 class="mt-5 text-white">Статистика регистраций пользователей</h2>
                <canvas class="mt-5" id="myChart" width="600" height="400"></canvas>
                <script>

                    let months = <?php  echo json_encode($months); ?>;
                    let userCounts = <?php echo json_encode($userCount); ?>;

                    // Построение графика с использованием Chart.js
                    let ctx = document.querySelector('#myChart').getContext('2d');
                    let myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: months,
                            datasets: [{
                                label: 'Количество зарегистрированных пользователей',
                                data: userCounts,
                                borderColor: '#ff00f2',
                                borderWidth: 4,
                            }],
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1,
                                    }
                                }
                            },
                        }
                    });
                </script>
            </div>

        </div>

    </div>
</main>

<?php $view->components('end'); ?>
