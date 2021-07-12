@extends('main')
@if($errors->any())
    <h1>{{ $errors->first() }}</h1>
    @endif
<div class="popup login">
    <div class="popup__background"></div>
    <div class="popup__wrapper">
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'Seller')">Продавец</button>
            <button class="tablinks" onclick="openTab(event, 'Customer')">Покупатель</button>
        </div>
        <div id="Seller" class="tabcontent">
            <p class="popup__title">Регистрация в MW</p>
            <form action=" {{ route('RegisterSeller') }} ">
                @csrf
                <div class="form__field">
                    <input type="text" name="companyName" placeholder="Название компании">
                </div>
                <div class="form__field">
                    <input type="text" name="website" placeholder="Сайт">
                </div>
                <div class="multiselect">
                    <div class="selectBox" onclick="showCheckboxes()">
                        <select>
                            <option>Select an option</option>
                        </select>
                        <div class="overSelect"></div>
                    </div>
                    <div id="checkboxes">
                        @foreach($categories as $category)
                        <label for="{{ $category->category_name }}">
                            <input type="checkbox" id="{{ $category->category_name }}" name="category[{{ $category->category_name }}]"/>
                            {{ $category->category_name }}
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="form__field">
                    <input type="email" name="email" placeholder="E-mail">
                </div>
                <div class="form__field">
                    <input type="password" name="password" placeholder="Пароль">
                </div>
                <div class="form__field">
                    <input type="password" name="password_repeat" placeholder="Повторите пароль">
                </div>

                <button type="submit">Регистрация</button>

            </form>
        </div>
        <div id="Customer" class="tabcontent">
            <p class="popup__title">Регистрация в MW</p>
            <form action=" {{ route('RegisterCustomer') }}">
                <div class="form__field">
                    <input type="text" name="name" placeholder="Имя">
                </div>
                <div class="form__field">
                    <input type="text" name="surname" placeholder="Фамилия">
                </div>
                <div class="form__field">
                    <input type="email" name="email" placeholder="E-mail">
                </div>
                <div class="form__field">
                    <input type="password" name="password" placeholder="Пароль">
                </div>
                <div class="form__field">
                    <input type="password" name="password_repeat" placeholder="Повторите пароль">
                </div>
                <div>
                    <input type="radio" id="wholesale" name="customer_type" value="wholesale"
                           checked>
                    <label for="huey">Розничний покупатель</label>
                </div>

                <div>
                    <input type="radio" id="retail" name="customer_type" value="retail">
                    <label for="dewey">Оптовый покупатель</label>
                </div>
                <br>
                <button type="submit">Регистрация</button>

                <div class="popup__social-auth">
                    <p>Регистрация с помощью</p>
                    <ul>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 167.657 167.657" style="enable-background:new 0 0 167.657 167.657;" xml:space="preserve"> <g> <path style="fill:#010002;" d="M83.829,0.349C37.532,0.349,0,37.881,0,84.178c0,41.523,30.222,75.911,69.848,82.57v-65.081H49.626 v-23.42h20.222V60.978c0-20.037,12.238-30.956,30.115-30.956c8.562,0,15.92,0.638,18.056,0.919v20.944l-12.399,0.006 c-9.72,0-11.594,4.618-11.594,11.397v14.947h23.193l-3.025,23.42H94.026v65.653c41.476-5.048,73.631-40.312,73.631-83.154 C167.657,37.881,130.125,0.349,83.829,0.349z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                        </li>
                        <li>
                            <svg enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m12 24c6.624 0 12-5.376 12-12s-5.376-12-12-12-12 5.376-12 12 5.376 12 12 12zm4.283-12.857h1.718v-1.717h1.718v1.718h1.703v1.718h-1.703v1.718h-1.718v-1.718h-1.718zm-7.704-5.144c1.514 0 2.908.533 4.017 1.563l-1.626 1.578c-.639-.625-1.514-.924-2.391-.924-2.076 0-3.736 1.718-3.736 3.779s1.655 3.779 3.736 3.779c1.577 0 3.14-.924 3.392-2.579h-3.392v-2.061h5.657c.063.329.092.658.092 1.001 0 3.426-2.299 5.864-5.749 5.864v.001c-3.329 0-6.001-2.686-6.001-6.001s2.672-6 6.001-6z"/></svg>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>
