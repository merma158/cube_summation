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
    x     = command[0].to_i  # X
    y     = command[1].to_i  # Y
    z     = command[2].to_i  # Z
    value = command[3].to_i  # W

    set_coordenate_xyz(x, y, z, value)
  end

  def execute_query(command = [])
    @cube = initialize_cube if @cube.nil?
  end

  private

    def process_prepare
      # Get Matriz Size and Get Operations number
      matrix_size_and_operations_number = gets.chomp
      # Validate KeyBoard Input
      abort @messages[:matriz_define] unless /\d\s{1}\d/ =~ matrix_size_and_operations_number

      # Separate KeyBoard Input
      n_m = matrix_size_and_operations_number.split
      n   = n_m.first.to_i
      m   = n_m.last.to_i
      # Constrains - Validate 1 <= N <= 100
      abort @messages[:size_n] if n < 1 && n > 100
      # Constrains - Validate 1 <= N <= 1000
      abort @messages[:size_m] if m < 1 && m > 1000

      # Begin Process
      process(n, m)
    end

    def operation_prepare
      print "promt/>:"
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

    def set_coordenate_xyz(x, y, z, value)
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
end

objeto = CubeSummation.new
objeto.run
puts "Finish!"
