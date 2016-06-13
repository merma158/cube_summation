# Cube Summation
class CubeSummation
  # Variables and Constans Definition
  UPDATE_COMMAND = /[update|UPDATE]\s{1}\d+\s{1}\d+\s{1}\d+\s{1}\d+$/
  QUERY_COMMAND  = /[query|QUERY]\s{1}\d+\s{1}\d+\s{1}\d+\s{1}\d+\s{1}\d+\s{1}\d+$/

  def initialize(matriz_size = nil)

    @messages = {
      :test_cases    => "The first line contains an integer, the number of test-cases.",
      :matriz_define => "the second line will contain two integers N and M separated by a single space.\nN defines the N * N * N matrix.\nM defines the number of operations.",
      :size_t        => "1 <= T <= 50",
      :size_n        => "1 <= N <= 100",
      :size_m        => "1 <= M <= 1000",
      :size_x        => "1 <= x1 <= x2 <= N",
      :size_y        => "1 <= y1 <= y2 <= N",
      :size_z        => "1 <= z1 <= z2 <= N",
      :size_xyz      => "1 <= x,y,z <= N",
      :size_w        => "-10^9 <= W <= 10^9",
      :unknow        => "unknow command" 
    }

    begin
      initialize_cube(matriz_size)
    end unless matriz_size.nil?
  end

  def run
    # Get Number of TestCases
    number_test_cases = gets.chomp
    # Validate KeyBoard Input
    abort @messages[:test_cases] unless /\d/ =~ number_test_cases
    # Constrains - Validate 1 <= T <= 50
    abort @messages[:size_t] if number_test_cases.to_i < 1 && number_test_cases.to_i > 50

    iterations = 0
    while iterations < number_test_cases.to_i
      process_prepare
      iterations += 1
    end
  end

  def process(n, m)
    @cube      = initialize_cube(n) if @cube.nil?
    iterations = 0

    while iterations < m
      operation_prepare
      iterations += 1
    end
  end

  def execute_update(command = [])
    @cube = initialize_cube if @cube.nil?
      
    command.delete_at(0)
    command = command.collect { |coordinate| coordinate.to_i - 1 }
    validate_update_params(command)

    x     = command[0].to_i     # X
    y     = command[1].to_i     # Y
    z     = command[2].to_i     # Z
    value = command[3].to_i + 1 # W

    set_coordinate_xyz(x, y, z, value)
  end

  def execute_query(command = [])
    @cube = initialize_cube if @cube.nil?

    command.delete_at(0)
    command = command.collect { |coordinate| coordinate.to_i - 1 }
    validate_query_params(command)

    x1     = command[0].to_i  # X1
    y1     = command[1].to_i  # Y1
    z1     = command[2].to_i  # Z1
    # ============================
    x2     = command[3].to_i  # X2
    y2     = command[4].to_i  # Y2
    z2     = command[5].to_i  # Z2

    acum   = 0

    for i in x1..x2
      for j in y1..y2
        for k in z1..z2
          acum += @cube[i][j][k]
        end
      end
    end

    puts acum
  end

  private

    def process_prepare
      # Get Matriz Size and Get Operations number
      matrix_size_and_operations_number = gets.chomp
      # Validate KeyBoard Input
      abort @messages[:matriz_define] unless /\d\s{1}\d/ =~ matrix_size_and_operations_number

      # Separate KeyBoard Input
      n_m   = matrix_size_and_operations_number.split
      n     = n_m.first.to_i
      m     = n_m.last.to_i
      @cube = nil
      # Constrains - Validate 1 <= N <= 100
      abort @messages[:size_n] if n < 1 && n > 100
      # Constrains - Validate 1 <= N <= 1000
      abort @messages[:size_m] if m < 1 && m > 1000

      # Begin Process
      process(n, m)
    end

    def operation_prepare
      # Get operation command
      operation_command = gets.chomp
      # Validate KeyBoard Input
      abort @messages[:unknow] unless valid_command?(operation_command)

      # Separate KeyBoard Input
      current_operation = operation_command.split
      
      case current_operation.first.downcase.to_sym
        when :query
          execute_query(current_operation)
        when :update
          execute_update(current_operation)
      end
    end

    def set_coordinate_xyz(x, y, z, value)
      @cube[x][y][z] = value
    end

    def initialize_cube(size = nil)
      set_matriz_size(size) if !size.nil? || @n.nil?
      Array.new(@n) { Array.new(@n) { Array.new(@n, 0) } }
    end

    def set_matriz_size(size)
      @n =  size.nil? ? 1 : size
    end

    def valid_command?(command)
      UPDATE_COMMAND =~ command || 
      QUERY_COMMAND  =~ command
    end

    def validate_update_params(params)
      return false unless params.kind_of?(Array)
      # ==========================
      x     = params[0].to_i  # X
      y     = params[1].to_i  # Y
      z     = params[2].to_i  # Z
      
      coordinate_minor_regular_value = (x < 0  || y < 0  || z < 0)
      coordinate_max_regular_value   = (x > @n || y > @n || z > @n)

      abort @messages[:size_xyz] if coordinate_minor_regular_value || coordinate_max_regular_value
    end

    def validate_query_params(params)
      return false unless params.kind_of?(Array)

      # ==========================
      x1     = params[0].to_i # X1
      y1     = params[1].to_i # Y1
      z1     = params[2].to_i # Z1
      # ==========================
      x2     = params[3].to_i # X2
      y2     = params[4].to_i # Y2
      z2     = params[5].to_i # Z2

      abort @messages[:size_x] unless (x1 >= 0  &&  x1 <= x2 &&  x2 <= @n - 1) 
      abort @messages[:size_y] unless (y1 >= 0  &&  y1 <= y2 &&  y2 <= @n - 1)
      abort @messages[:size_z] unless (z1 >= 0  &&  z1 <= z2 &&  z2 <= @n - 1)
      
      true
    end
end

objeto = CubeSummation.new
objeto.run
