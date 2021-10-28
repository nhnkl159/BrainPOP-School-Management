
# BrainPOP School Management

The goal of this exam is to create a working REST API for accessing and manipulating school entities, using the Laravel PHP framework.


## Database Design

![Database](https://i.imgur.com/MXxLmQj.png)


## Installation

Install my-project with npm

```bash
  cd brainpop-school-managment
  composer install
  php artisan migrate:fresh --seed
```
    
## Running Tests

To run tests, run the following command

```bash
  phpunit
```


## API Reference
### Authentication

#### Authenticate as student:

```http
  POST /auth/student
```

| FormData | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `username` | `string` | **Required**. |
| `password` | `string` | **Required**. |

#### Authenticate as teacher:

```http
  POST /auth/teacher
```

| FormData | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `username` | `string` | **Required**. |
| `password` | `string` | **Required**. |

### End Points

#### All end-points should have `Authentication:` `Bearer <Token>` header except `students or teacher creation!`

#### Get all students

```http
  GET /api/students
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `teacher_id` | `integer` | **Optional**. Get all students by specific teacher. |
| `period_id` | `integer` | **Optional**. Get all students by specific period. |

#### Get student

```http
  GET /api/students/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `integer` | **Required**. ID of student to fetch |


#### Store new student

```http
  POST /api/students
```

| FormData | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `username` | `string` | **Required**. |
| `password` | `string` | **Required**. |
| `full_name` | `string` | **Required**. |
| `grade` | `integer` | **Required** Between 1-12. |

#### Update  student

```http
  PUT /api/students/${id}
```

| FormData | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `password` | `string` | **Required**. |
| `full_name` | `string` | **Required**. |
| `grade` | `integer` | **Required** Between 1-12. |

#### Delete student

```http
  DELETE /api/students/${id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id`      | `integer` | **Required**. ID of student to delete |

---------------------------

#### Get all teachers

```http
  GET /api/teachers
```

#### Get teacher

```http
  GET /api/teachers/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `integer` | **Required**. ID of teacher to fetch |


#### Store new teacher

```http
  POST /api/teachers
```

| FormData | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `username` | `string` | **Required**. |
| `password` | `string` | **Required**. |
| `full_name` | `string` | **Required**. |
| `email` | `string` | **Required** |

#### Update teacher

```http
  PUT /api/teachers/${id}
```

| FormData | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `password` | `string` | **Required**. |
| `full_name` | `string` | **Required**. |
| `email` | `string` | **Required** |

#### Delete teacher

```http
  DELETE /api/teachers/${id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id`      | `integer` | **Required**. ID of teacher to delete |

---------------------------

#### Get all periods

```http
  GET /api/teachers
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `teacher_id` | `integer` | **Optional**. Get all periods by specific teacher. |


#### Get period

```http
  GET /api/periods/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `integer` | **Required**. ID of period to fetch |


#### Store new period

```http
  POST /api/periods
```

| FormData | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `teacher_id` | `integer` | **Required**. |
| `name` | `string` | **Required**. |

#### Update period

```http
  PUT /api/periods/${id}
```

| FormData | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `teacher_id` | `integer` | **Required**. |
| `name` | `string` | **Required**. |

#### Delete period

```http
  DELETE /api/periods/${id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id`      | `integer` | **Required**. ID of period to delete |